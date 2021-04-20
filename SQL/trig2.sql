-- Upon a person’s test result is determined, a trigger must send a message to the person
-- notifying him/her of the test result.

delimiter //
CREATE TRIGGER test_result
    AFTER INSERT
    ON Test
    FOR EACH ROW
BEGIN
    SET @result_message = Concat('Your test result is: ', NEW.results);

    SET @test_region = (
        SELECT City.region_name
        FROM Postal_Code,
             City
        WHERE Postal_Code.city_name = City.city_name
          AND postal_code = (
            SELECT postal_code
            FROM Person
            WHERE medicare_num = NEW.conducted_on
        )
    );

    INSERT INTO Message (date_time,
                         description,
                         old_alert,
                         new_alert,
                         person,
                         region_name)
    VALUES (NOW(),
            @result_message,
            NULL,
            NULL,
            NEW.conducted_on,
            @test_region);

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

    END;//
delimiter ;