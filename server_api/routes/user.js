/**
 * Created by Killian on 25/02/2016.
 */
var user = require('../models/user.js');
var hat = require('hat');

module.exports= {
    route : function(router){
        router.route('/user/search').get(function(req, res){
            console.log(req.query);
            if(!req.query.username)
                res.json({code:400, message:"Missing parameters"})
            else{
                user.getUserFromLogin(req.query.username, req.user.login,function(err, result){
                    if(err) {
                        res.json(err);
                    }
                    else {
                        for(var i =0; i < result.length; i++){
                            result[i].id = result[i].login;
                            result[i].name = result[i].login;
                        }

                        res.json(result)
                    }
                })
            }
        })

        router.route('/user').post(function(req, res){
            if(!req.body.login || !req.body.password){
                res.json({code:400, message:"Missing parameters"})
            }
            else {
                user.createUser(req.body.login, req.body.password, hat(), function (err, result) {
                    if (err) {
                        res.json(err);
                    }
                    else {
                        res.json({code:201, message:"user created", user:result});
                    }
                })
            }
        })

        router.route('/authenticate').post(function(req, res){
            console.log("login : " + req.body.login + " password : " + req.body.password);
            user.getUser(req.body.login, req.body.password, function(err, result){
                if(err) {
                    res.json(err);
                }
                else {
                    res.json(result)
                }
            })
        })
    }
}