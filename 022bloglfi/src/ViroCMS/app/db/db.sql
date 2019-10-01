CREATE TABLE users (
	id integer PRIMARY KEY AUTOINCREMENT,
	username varchar,
	email varchar,
	password varchar,
	read varchar,
	write varchar,
	users varchar,
	tools varchar,
	last_login varchar,
	active integer
);

CREATE TABLE groups (
	id integer PRIMARY KEY AUTOINCREMENT,
	g_name varchar,
	g_slug varchar,
	g_hash varchar,
	u_id integer,
	created varchar,
    FOREIGN KEY(u_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE zones (
	id integer PRIMARY KEY AUTOINCREMENT,
	z_name varchar,
	z_slug varchar,
	z_hash varchar,
	g_id integer,
	z_owner integer,
	created varchar,
    FOREIGN KEY(g_id) REFERENCES groups(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE content (
	id integer PRIMARY KEY AUTOINCREMENT,
	content varchar,
	c_hash varchar,
	z_id integer,
	edit_by integer,
	created varchar,
	updated varchar,
    FOREIGN KEY(z_id) REFERENCES zones(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE articles (
	id integer PRIMARY KEY AUTOINCREMENT,
	title varchar,
	u_id integer,
	content varchar,
	a_hash varchar,
	created varchar,
	updated varchar,
	published integer,
    FOREIGN KEY(u_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE backups (
	id integer PRIMARY KEY AUTOINCREMENT,
	title varchar,
	u_id integer,
	created varchar,
    FOREIGN KEY(u_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

