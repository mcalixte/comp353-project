-- Once a new alert is set for a region, a trigger must send message(s) to all the people that
-- are registered in that region informing them of the new alert state, and also inform them
-- whether the alert is more strict or less strict than the previous alert. The system must also
-- notify the people of the policy or restrictions to follow

delimiter //
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
    END;//
delimiter ;