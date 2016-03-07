create table users(
	login Varchar(25) not null,
	password Varchar(25),
	token TEXT,
	PRIMARY KEY(login)
);

create table picture(
	idPicture INT not null AUTO_INCREMENT,
	filename Varchar(50),
	login Varchar(25),
	longitude DOUBLE,
	latitude DOUBLE,
	PRIMARY KEY(idPicture),
	FOREIGN KEY (login) REFERENCES users(login) ON DELETE CASCADE
);

create table friend(
	login1 Varchar(25),
	login2 Varchar(25),
	FOREIGN KEY (login1) REFERENCES users(login) ON DELETE CASCADE,
	FOREIGN KEY (login2) REFERENCES users(login) ON DELETE CASCADE,
	PRIMARY KEY(login1, login2)
);











