/**
 * Created by Killian on 25/02/2016.
 */
var connection = require('./connection.js');
var mysql = require('mysql');

module.exports = {
    createUser : function(login, password, token, callback){
        var sql = "SELECT * FROM users WHERE login = ?"
        var inserts = [login]
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                return callback({code:500,message:err.code})
            if(rows > 0)
                return callback({code : 409, message : "Ce compte existe déjà"});
            sql = "INSERT INTO users (login, password, token) values(?,?,?)"
            inserts = [login, password, token]
            sql = mysql.format(sql, inserts)
            connection.query(sql, function(err, rows){
                if(err) {
                    console.log(err)
                    return callback({code: 500, message: err.code})
                }
                return callback(null, {login : rows.insertId})
            })
        })
    },

    getUser : function(login, password, callback){
        var sql = "SELECT * FROM users WHERE login = ? AND password = ?"
        var inserts = [login, password];
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                return callback(err);
            if(rows <= 0)
                return callback({code:204, message : "Mauvais mot de passe ou login"})
            return callback(null, rows[0]);
        })
    },

    getUserFromToken : function(token, callback){
        var sql = "SELECT * FROM users WHERE token = ?"
        var inserts = [token];
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                return callback({code:500, message:err.code});
            if(rows <= 0)
                return callback({code : 401, message : "Token invalide"})
            return callback(null, rows[0]);
        })
    },

    getUserFromLogin : function(username, login, callback){
        var sql = "SELECT login FROM users WHERE login LIKE ? AND login <> ? AND NOT " +
            "EXISTS (SELECT 1 FROM friend WHERE login1 = ? AND login2 = users.login)"
        var inserts = [username+'%', login, login];
        sql = mysql.format(sql, inserts);
        connection.query(sql, function(err, rows){
            if(err)
                return callback({code:500, message:err.code});
            if(rows <= 0)
                return callback({code : 404, message : "No User Found"})
            return callback(null, rows);
        })
    }
}