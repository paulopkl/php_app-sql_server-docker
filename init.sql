USE master;
GO

CREATE DATABASE DatabaseTest;
GO

ALTER DATABASE DatabaseTest SET READ_WRITE;
GO

USE DatabaseTest;
GO

CREATE LOGIN paulo_user WITH PASSWORD = 'P@ulo123';
GO

CREATE USER paulo_user FOR LOGIN paulo_user;
GO

EXEC sp_addrolemember 'db_owner', 'paulo_user';
GO

USE DatabaseTest
GO

CREATE TABLE Members (
    [MemberID] [int] IDENTITY(1,1) NOT NULL,
    [FirstName] [varchar](50) NULL,
    [LastName] [varchar](50) NULL,
    [Email] [varchar](50) NULL,
    [Country] [varchar](50) NULL,
    [Created] [datetime] NULL
);
GO