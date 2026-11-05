<?php
$dbDir=__DIR__.'/../data';
if(!is_dir($dbDir)) mkdir($dbDir,0775,true);
$dbFile=$dbDir.'/k2careerhub.sqlite';
try{$pdo=new PDO('sqlite:'.$dbFile);$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);$pdo->exec('PRAGMA foreign_keys = ON');}
catch(Throwable $e){die('SQLite is not available. Enable PHP PDO_SQLite and SQLite3 extensions. Details: '.h($e->getMessage()));}
$pdo->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,email TEXT UNIQUE NOT NULL,password TEXT NOT NULL,role TEXT NOT NULL DEFAULT 'student',created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
$pdo->exec("CREATE TABLE IF NOT EXISTS colleges(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,city TEXT,kind TEXT,description TEXT,website TEXT,featured INTEGER DEFAULT 0,created_at TEXT DEFAULT CURRENT_TIMESTAMP)");
$pdo->exec("CREATE TABLE IF NOT EXISTS courses(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,level TEXT,stream TEXT,duration TEXT,mode TEXT DEFAULT 'Regular')");
$pdo->exec("CREATE TABLE IF NOT EXISTS admissions(id INTEGER PRIMARY KEY AUTOINCREMENT,student_id INTEGER NOT NULL,college_id INTEGER,course TEXT NOT NULL,session TEXT,mode TEXT DEFAULT 'Regular',status TEXT DEFAULT 'Enquiry',fee REAL DEFAULT 0,paid REAL DEFAULT 0,counsellor TEXT,notes TEXT,created_at TEXT DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(student_id) REFERENCES users(id),FOREIGN KEY(college_id) REFERENCES colleges(id))");
$pdo->exec("CREATE TABLE IF NOT EXISTS gallery(id INTEGER PRIMARY KEY AUTOINCREMENT,college_id INTEGER NOT NULL,image_path TEXT NOT NULL,caption TEXT,sort_order INTEGER DEFAULT 0,FOREIGN KEY(college_id) REFERENCES colleges(id) ON DELETE CASCADE)");
$check=$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
if(!$check){
 $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
 $stmt->execute(['K2 Admin','admin@k2careerhub.local',password_hash('Admin@123',PASSWORD_DEFAULT),'admin']);
 $stmt->execute(['Demo Student','student@k2careerhub.local',password_hash('Student@123',PASSWORD_DEFAULT),'student']);
 $c=$pdo->prepare("INSERT INTO colleges(name,city,kind,description,website,featured) VALUES(?,?,?,?,?,1)");
 $samples=[
 ['Amity University','Noida, Uttar Pradesh','Private University','Demo profile for preview only. Replace with verified institution information.','https://www.amity.edu'],
 ['Delhi Technical Institute','Delhi','College','Demo institution profile. All information is sample content.',''],
 ['North Valley University','Dehradun, Uttarakhand','Private University','Demo profile for preview only.','']
 ];
 foreach($samples as $v)$c->execute($v);
 $co=$pdo->prepare("INSERT INTO courses(name,level,stream,duration,mode) VALUES(?,?,?,?,?)");
 foreach([['B.Tech','UG','Engineering','4 Years','Regular'],['MBA','PG','Management','2 Years','Regular'],['BCA','UG','Computer Applications','3 Years','Regular'],['B.Com','UG','Commerce','3 Years','Regular'],['MBA','PG','Management','2 Years','Distance'],['BA','UG','Arts','3 Years','Distance']] as $v)$co->execute($v);
}
