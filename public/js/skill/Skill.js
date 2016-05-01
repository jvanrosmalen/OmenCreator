function Skill(id, name, ep_cost, level, levelName, descriptionSmall, descriptionLong, mentorRequired){
	this.id = id;
	this.name = name;
	this.ep_cost = ep_cost;
	this.level = level;
	this.levelName = levelName;
	this.descriptionSmall = descriptionSmall;
	this.descriptionLong = descriptionLong;
	this.mentorRequired = mentorRequired;
	
	this.skillPrereqs = [];
	this.classes = [];
	this.races = [];
	this.incomeAmount = 0;
	this.incomeLevel = null;
}