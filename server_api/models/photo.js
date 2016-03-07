/**
 * Created by Killian on 25/02/2016.
 */
var connection = require('./connection.js');
var mysql = require('mysql');

module.exports = {
    addPicture : function(login, filename, longitude, latitude, callback){
        var sql = "INSERT INTO picture (filename, login, longitude, latitude) values(?,?,?,?)"
        var inserts=[filename, login, longitude, latitude]
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                callback({code:500,message:err.code});
            else
                callback(null, rows);
        })
    },

    getPicture : function(login, callback){
        var sql = "SELECT * from picture WHERE login = ? OR login IN (SELECT login2 " +
            "FROM friend WHERE login1 = ?)"
        var inserts = [login, login]
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            console.log(err)
            if(err)
                callback({code:500,message:err.code});
            else
                callback(null, rows);
        })
    }
}