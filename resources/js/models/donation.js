export default
class donation {
    constructor(
        about_item = '',
        name = '',
        email = '',
        phone = '',
        pickedup_address = '',
        remark = '',
        pickedup_at = '',
        image = null,
        ) {
        this.about_item = about_item;
        this.name = name;
        this.email = email;
        this.phone = phone;
        this.pickedup_address = pickedup_address;
        this.remark = remark;
        this.pickedup_at = pickedup_at;
        this.image = image;
    }
}