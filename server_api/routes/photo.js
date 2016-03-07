/**
 * Created by Killian on 25/02/2016.
 */
var photo = require('../models/photo.js');
var multer = require('multer');


module.exports= {
    route : function(router) {
        router.route('/photo').post(function(req, res){
            if(/image\/*/.test(req.file.mimetype)) {
                photo.addPicture(req.user.login, req.file.filename, req.body.longitude, req.body.latitude, function (err, result) {
                    if (err)
                        res.json(err)
                    else {
                        res.json({code: 201, message: "picture posted"})
                    }
                })
            }
            else{
                var fs = require('fs')
                fs.unlink(req.file.path);
                res.json({code: 400, message: "Not a picture"})
            }
        });

        router.route('/photo').get(function(req, res){
            photo.getPicture(req.user.login, function(err, result){
                if(err){
                    res.send(err);
                }
                else{
                    res.json(result);
                }
            })
        });

        router.route('/photo/:picture').get(function(req, res){
            var path = require('path');
            res.sendFile(path.resolve(__dirname+'/../views/img/'+req.params.picture));
        })
    }
}