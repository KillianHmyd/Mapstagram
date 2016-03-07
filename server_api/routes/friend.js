/**
 * Created by Killian on 25/02/2016.
 */
var friend = require('../models/friend.js');

module.exports= {
    route : function(router) {
        router.route('/friend').post(function(req, res){
            if(req.user.login == req.body.login){
                res.json({code : 400, message : "You can't add yourself as a friend"})
            }
            else {
                friend.addFriend(req.user.login, req.body.login, function (err, rows) {
                    if (err) {
                        res.send(err);
                    }
                    else {
                        res.json({code: 201, message: "User added"});
                    }
                })
            }
        });

        router.route('/friend').get(function(req, res){
            friend.getFriend(req.user.login, function(err, rows){
                if(err) {
                    res.json(err)
                }
                else {
                    res.json(rows)
                }
            })
        })
    }
}
