-- Once a new alert is set for a region, a trigger must send message(s) to all the people that
-- are registered in that region informing them of the new alert state, and also inform them
-- whether the alert is more strict or less strict than the previous alert. The system must also
-- notify the people of the policy or restrictions to follow

CREATE TRIGGER new_alert
    BEFORE INSERT
    ON Alert_History
    FOR EACH ROW
    BEGIN

        SET @old_alert_level = (
            SELECT alert_level
            FROM Alert_History
            WHERE NEW.region_name = region_name
            AND is_active = 1
        );

        SET @alert_measures = (
            SELECT measures
            FROM Alert_Level
            WHERE NEW.alert_level = alert_level
        );

        SET @alert_message = Concat('Alert Level ', CONVERT(NEW.alert_level, CHAR), ' - ', @alert_measures);

        INSERT INTO Message (
            date_time,
            description,
            old_alert,
            new_alert,
            person,
            region_name
            )
        SELECT NOW(), @alert_message, @old_alert_level, NEW.alert_level, medicare_num, NEW.region_name
        FROM Person
        WHERE postal_code IN (
            SELECT Postal_Code.postal_code
            FROM Postal_Code,
                    City
            WHERE Postal_Code.city_name = City.city_name
                AND City.region_name = NEW.region_name);
    END;



-- Upon a person’s test result is determined, a trigger must send a message to the person 
-- notifying him/her of the test result.

CREATE TRIGGER test_result
    AFTER INSERT
    ON Test
    FOR EACH ROW
    BEGIN
        SET @result_message = Concat('Your test result is: ', NEW.results);

        SET @test_region = (
            SELECT City.region_name FROM Postal_Code, City
            WHERE Postal_Code.city_name = City.city_name
            AND postal_code = (
                SELECT postal_code FROM Person
                WHERE medicare_num = NEW.conducted_on
            )
        );

        INSERT INTO Message (
            date_time,
            description,
            old_alert,
            new_alert,
            person,
            region_name
        ) VALUES (
            NOW(),
            @result_message,
            NULL,
            NULL,
            NEW.conducted_on,
            @test_region
        )

    -- If the test is positive, an additional message is sent to the person
    -- with information about the public health recommendations

        IF NEW.results = 'POS' THEN
            SET @recommendation_message = 'Follow Health Recommendations at https://xfc353.encs.concordia.ca/comp353-project/C19PHCS/Recommendation/';

            INSERT INTO Message (
                date_time,
                description,
                old_alert,
                new_alert,
                person,
                region_name
            ) VALUES (
                NOW(),
                @recommendation_message,
                NULL,
                NULL,
                NEW.conducted_on,
                @test_region
            );

        END IF;   

    END;
