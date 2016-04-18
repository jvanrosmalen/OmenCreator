/**
 * 
 */

var Skill = function(id, name, ep_cost, level, descriptionSmall, descriptionLong){
	this.id = id;
	this.name = name;
	this.ep_cost = ep_cost;
	this.level = level;
	this.descriptionSmall = descriptionSmall;
	this.descriptionLong = descriptionLong;
	
	this.skillPrereqs = [];
	this.incomeAmount = 0;
	this.incomeLevel = null;
}