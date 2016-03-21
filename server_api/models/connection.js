/**
 * Created by Killian on 25/02/2016.
 */
var mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'USER',
    password : 'PASSWORD',
    database : 'DATABASE_NAME'
});

module.exports = connection;
