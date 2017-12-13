mongo = new Mongo();

dbs = mongo.adminCommand('listDatabases')['databases'].map(function (el) {
    return el['name'];
});

printjson(dbs);
printjson(mongo.adminCommand({'getLog': 'global'}));
