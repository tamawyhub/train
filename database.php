<?php
class database{
	function __construct(){
		$this->pdo=new PDO("mysql:host=localhost","root","");
		$this->pdo->exec("create database if not exists startion_train");
		$this->pdo->exec("use startion_train");
		$this->pdo->exec("create table if not exists users(email varchar(50) not null primary key ,firstname varchar(50),lastname varchar(50),pass varchar(10));");
		$this->pdo->exec("create table if not exists trains(id int not null primary key ,start varchar(50),end varchar(50),start_date date);");
		$this->pdo->exec("create table if not exists booking(id int,email varchar(50))");
	
	}
	function getRows($q,$p=array()){
		$res=$this->pdo->prepare($q);
		$res->execute($p);
		return $res->fetchAll();
	}
	function Execute($q){
		$this->pdo->exec($q);
	}
	
}
?>