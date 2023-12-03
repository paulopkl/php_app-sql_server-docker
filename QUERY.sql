DROP TABLE testes;

CREATE TABLE testes (
	id			INT IDENTITY(1,1) NOT NULL,
	name		VARCHAR(255),
	description TEXT,
	CPF			VARCHAR(15) UNIQUE NOT NULL,
	PRIMARY KEY(id)
);

GO
INSERT INTO testes (name, description, CPF) VALUES ('Paulo', 'pessoa - funcionário', '111.111.111-11')

SELECT * FROM testes;
