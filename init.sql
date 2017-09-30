
/**
 * Database creation script
 */


 
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    login VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    nick VARCHAR NOT NULL
);

/*
todo : reintroduce 
    startTime DATETIME NOT NULL,
*/
DROP TABLE IF EXISTS games;
CREATE TABLE games (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    player1 VARCHAR NOT NULL,
    player2 VARCHAR NOT NULL,
    result INTEGER NOT NULL,
    sentMove INTEGER NOT NULL,
    lastMove INTEGER NOT NULL,
    turnNum INTEGER NOT NULL,
    activePlayer INTEGER NOT NULL,
    movesLeft INTEGER NOT NULL
);

DROP TABLE IF EXISTS gameRequests;
CREATE TABLE gameRequests (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    sender VARCHAR NOT NULL,
    recipient VARCHAR NOT NULL,
    player1 VARCHAR NOT NULL,
    player2 VARCHAR NOT NULL,
    state INTEGER NOT NULL
);

DROP TABLE IF EXISTS finishedGames;
CREATE TABLE finishedGames(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    sender VARCHAR NOT NULL,
    recipient VARCHAR NOT NULL,
    player1 VARCHAR NOT NULL,
    player2 VARCHAR NOT NULL,
    state INTEGER NOT NULL
);
 
 
DROP TABLE IF EXISTS units;
CREATE TABLE units (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    gameId INTEGER NOT NULL,
    unitType INTEGER NOT NULL,
    x INTEGER NOT NULL,
    y INTEGER NOT NULL,
    hp INTEGER NOT NULL,
    moves INTEGER NOT NULL,
    ammo INTEGER NOT NULL,
    status INTEGER NOT NULL
);

DROP TABLE IF EXISTS moves;
CREATE TABLE moves (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    gameId INTEGER NOT NULL,
    moveNum INTEGER NOT NULL,
    x1 INTEGER NOT NULL,
    x2 INTEGER NOT NULL,
    y1 INTEGER NOT NULL,
    y2 INTEGER NOT NULL,
    moveType INTEGER NOT NULL,
    side INTEGER NOT NULL,
    arg1 INTEGER,
    arg2 INTEGER,
    arg3 INTEGER,
    arg4 INTEGER
);



INSERT INTO
	units
	(gameId, unitType, x, y, hp, moves, ammo, status)
VALUES
	(1,1,5,3,14,0,1,0),
	(1,2,2,1,12,2,1,0),
	(1,1,10,7,24,0,0,0),
	(1,1,9,3,3,0,1,0),
	(2,1,6,7,15,0,1,0),
	(2,2,10,7,24,0,0,0),
	(2,2,5,3,3,2,1,0)
;

INSERT INTO
	games
	(player1, player2, result, sentMove, lastMove, turnNum, activePlayer, movesLeft)
VALUES
	("Lorem","Ipsum",0,0,0,0,0,1),
	("Lorem","Kasparev",0,0,0,1,1,14)
;
