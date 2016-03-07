/**
 * Created by Killian on 25/02/2016.
 */
var connection = require('./connection.js');
var mysql = require('mysql');

module.exports = {
    addFriend : function(login1, login2, callback){
        var sql = "INSERT INTO friend values(?,?)"
        var inserts = [login1, login2]
        sql = mysql.format(sql, inserts)
        connection.query(sql, function(err, rows){
            if(err) {
                if(err.code == "ER_DUP_ENTRY")
                    callback({code: 409, message: "Users are already friend"});
                else {
                    callback({code: 500, message: err.code});
                }
            }
            else{
                if(rows.affectedRows <= 0)
                    callback({code:204,message:"No user found"})
                callback(null, rows)
            }
        })
    },

    getFriend : function(login, callback){
        var sql = "SELECT login2 from friend where login1 = ?"
        var inserts = [login]
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                callback({code: 500, message: err.code});
            else
                callback(null, rows);
        })
    }
}