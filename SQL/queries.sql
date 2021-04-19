
-- 9

SELECT * FROM Symptom_history
WHERE person = ${person}
AND date_time >= ${date};

-- 10 

SELECT * FROM Message 
WHERE date_time Between ${after_date} AND ${before_date};


-- 11 
SELECT first_name, last_name, dob, medicare_num, phone_num, citizenship, email, postal_code, Relation.father_f_name, Relation.father_l_name, Relation.mother_f_name, Relation.mother_l_name
FROM Person,
    (SELECT p.child as child, p.parent as father, p.parent_f_name as father_f_name, p.parent_l_name as father_l_name,
    pe.parent as mother, pe.parent_f_name as mother_f_name, pe.parent_l_name as mother_l_name
    FROM
        (SELECT child, parent, relation, first_name as parent_f_name, last_name as parent_l_name FROM Parent, Person Where Parent.parent = Person.medicare_num) p,
        (SELECT child, parent, relation, first_name as parent_f_name, last_name as parent_l_name FROM Parent, Person Where Parent.parent = Person.medicare_num) pe
        WHERE p.child=pe.child
        AND p.relation='Father' AND pe.relation = 'Mother') Relation
    Where Person.medicare_num=Relation.child
    AND Person.postal_code = ${location};


-- 12 

SELECT *, (SELECT Count(*) FROM PHW WHERE PHW.phf_id = PHF.phf_id) as Number_of_workers
FROM PHF;


-- 13

SELECT Postal_Code.postal_code, City.city_name, City.region_name FROM Postal_Code, City 
WHERE Postal_Code.city_name = City.city_name;

-- 14
SELECT results, first_name, last_name, dob, phone_num, email from Test, Person 
WHERE result_date = ${result_date} AND Person.medicare_num = Test.conducted_on ORDER BY results;

-- 15
SELECT person, phw_id from PHW WHERE phf_id=${phf_id};

-- 16

-- Params: date, phf_id
--Get all positive PHWs
SELECT phw_id, test_date FROM PHW, Test WHERE PHW.person=Test.conducted_on AND results='POS' AND phf_id=${phf_id} AND test_date=${test_date};

--Params: date, phf_id, phw_id
--Get all the PHW who worked with the positive PHW at a specific date or 14 days before it
SELECT DISTINCT(PHW.phw_id) From Service_History, PHW 
WHERE PHW.phw_id=Service_History.phw_id 
AND phf_id=${phf_id}
AND PHW.phw_id <> ${phw_id}
AND service_date IN(
SELECT service_date FROM Service_History where phw_id = ${phw_id} AND service_date BETWEEN DATE_ADD(${test_date}, INTERVAL -14 day)
AND ${test_date});

-- 17 

SELECT City.region_name,
       Count(case Test.results when 'POS' then 1 else null end) as positive_cases,
       Count(case Test.results when 'NEG' then 1 else null end) as negative_cases
FROM Postal_Code, City, Person, Test
WHERE Postal_Code.city_name = City.city_name
    AND Person.postal_code = Postal_Code.postal_code
    AND Test.conducted_on = Person.medicare_num
    AND Test.result_date Between ${start_date} AND ${end_date}
GROUP BY City.region_name;


SELECT * FROM Alert_History WHERE date_issued BETWEEN ${start_date} AND ${end_date};
