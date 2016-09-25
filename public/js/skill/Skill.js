function Skill(id, name, ep_cost, level, levelName, descriptionSmall, descriptionLong, mentorRequired, incomeAmount, incomeCoin){
	this.id = id;
	this.name = name;
	this.ep_cost = ep_cost;
	this.level = level;
	this.levelName = levelName;
	this.descriptionSmall = descriptionSmall;
	this.descriptionLong = descriptionLong;
	this.mentorRequired = mentorRequired;
	this.incomeAmount = incomeAmount;
	this.incomeCoin = incomeCoin;
	
	this.skillPrereqs = [];
	this.classes = [];
	this.races = [];
	this.craftEquipments = [];
}