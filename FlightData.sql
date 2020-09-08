DROP DATABASE IF EXISTS W20FinalFlightData;
CREATE DATABASE W20FinalFlightData;
USE W20FinalFlightData;

create table flights (
    flightNo VARCHAR(50),
	destination VARCHAR(3),
    departing VARCHAR(50),
	passengers INT,
	arrivalDate VARCHAR(50)
);