create database dbForo7
go
Use dbForo7

go
CREATE TABLE Registros (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_PersonalMedico INT,
    especialidad VARCHAR(100),
    FechaHoraEntrada DATETIME,
    FechaHoraSalida DATETIME
);