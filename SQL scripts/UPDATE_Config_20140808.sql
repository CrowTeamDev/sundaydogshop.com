UPDATE `Config` SET `configValue`='For detailed information on our shipping policies, please visit our <a href="policy#shipping">Shipping Information page.</a>' WHERE `configName`='FAQ_answer-2';
UPDATE `Config` SET `configValue`='For detailed information on our returns and exchange policies, please visit our <a href="policy#return">Returns and Exchanges page.</a>' WHERE `configName`='FAQ_answer-3';
UPDATE `Config` SET `configValue`='No, definitely not.' WHERE `configName`='FAQ_answer-5';
UPDATE `Config` SET `configValue`='International orders will be dealt with on a case by case basis as shipping costs vary between different weights, dimensions and countries. If you live outside the Thailand and are interested in something, please let contact info@sundaydogshop.com' WHERE `configName`='FAQ_answer-6';
DELETE FROM `Config` WHERE `configName`='policy_consent';
