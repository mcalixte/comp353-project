CREATE TRIGGER upd_check BEFORE INSERT ON Alert_History
       FOR EACH ROW
       BEGIN

       @old_alert_level = 
        SELECT alert_level FROM Alert_History
        WHERE NEW.region_name = region_name AND is_active=1);

            IF NEW.alert_level < @old_alert_level THEN
            -- SEND MESSAGE TO ALL PEOPLE IN REGION level 1-3

                INSERT INTO Message (
                    date_time,
                    description,
                    old_alert,
                    new_alert,
                    person,
                    region_name
                    )   
                SELECT NOW(),'TEST MESSAGE', old_alert_level, NEW.alert_level, medicare_num, NEW.region_name
                FROM Person WHERE postal_code IN (
                SELECT Postal_Code.postal_code FROM Postal_Code, City
                WHERE Postal_Code.city_name = City.city_name AND City.region_name = NEW.region_name);
        
            ELSEIF NEW.alert_level > @old_alert_level AND NEW.alert_level != 4 THEN
            -- SEND MESSAGE TO ALL PEOPLE IN REGION LESS STRICT NOT LEVEL 4

           ;
           ELSEIF NEW.alert_level > @old_alert_level AND NEW.alert_level = 4 THEN
            -- SEND MESSAGE TO ALL PEOPLE IN REGION LESS STRICT LEVEL 4

            ;
       END;