/**
 * Created by Killian on 25/02/2016.
 */
var photo = require('../models/photo.js');
var multer = require('multer');


module.exports= {
    route : function(router) {
        router.route('/photo').post(function(req, res){
            //TODO vérifier que le fichier est bien une photo valide
            if(true) {
                var fs = require('fs')
                var hat = require('hat');
                var nameFile = hat();
                var picture = req.body.photo;
                console.log(nameFile)
                if(/^data:image\//.test(picture)) {
                    fs.writeFile(__dirname + '/../views/img/' + nameFile, picture, function (err) {
                        if (err) {
                            res.json(err)
                        }
                        else {
                            var picture =
                                photo.addPicture(req.user.login, nameFile, req.body.longitude, req.body.latitude, function (err, result) {
                                    if (err) {
                                        res.json(err)
                                    }
                                    else {
                                        res.json({code: 201, message: "picture posted"})
                                    }
                                })
                        }
                    })
                }
                else{
                    res.json({code: 415, message:"Invalid file"})
                }
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

        router.route('/photo').delete(function(req, res){
            photo.deletePicture(req.body.filename, req.user.login, function(err, result){
                if(err)
                    res.send(err)
                else {
                    var fs = require('fs')
                    var filePath = __dirname + '/../views/img/' + req.body.filename
                    fs.exists(filePath, function(exists) {
                        if(exists) {
                            fs.unlink(filePath);
                            res.json(result);
                        } else {
                            res.json({code: 404, message: "No picture found"})
                        }
                    });
                }
            })
        })
    }
}