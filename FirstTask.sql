START TRANSACTION;
CREATE TEMPORARY TABLE tmp AS (SELECT id,
                                      card_number,
                                      date(date) as date_transaction,
                                      sum(volume),
                                      service,
                                      address_id
                               FROM data
                               GROUP BY card_number, address_id, date_transaction);
TRUNCATE TABLE data;
ALTER TABLE `data` AUTO_INCREMENT = 1;
INSERT INTO `data`
SELECT * FROM tmp;
COMMIT;