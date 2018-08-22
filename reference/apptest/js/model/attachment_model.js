//返回一个附件对象为了兼容一期
function getAttachmentObj(id,name,type){
	var att;
	att.id=id;
	att.name=name;
	att.type=type;
	return att;
}
