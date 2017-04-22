function Skill(id, name, ep_cost, level, levelName,
		descriptionSmall, descriptionLong,	mentorRequired,
		incomeAmount, incomeCoin, statPrereqAmount, statPrereq){
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
	this.statPrereqAmount = statPrereqAmount;
	this.statPrereq = statPrereq;
	
	this.skillPrereqs = [];
	this.skillPrereqs["set1"] = [];
	this.skillPrereqs["set2"] = [];
	this.classes = [];
	this.race_prereqs = [];
	this.craftEquipments = [];
}