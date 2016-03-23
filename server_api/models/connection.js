/**
 * Created by Killian on 25/02/2016.
 */
var mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'killian',
    password : 'kiki2010',
    database : 'PWEB'
});

module.exports = connection;
