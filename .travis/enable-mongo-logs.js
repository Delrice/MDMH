mongo = new Mongo();
db    = mongo.getDB('project');

db.setProfilingLevel(2);
