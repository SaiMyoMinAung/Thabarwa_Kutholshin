export default
class donation {
    constructor(
        name = '',
        email = '',
        phone = '',
        pickedup_address = '',
        remark = '',
        ) {
        this.name = name;
        this.email = email;
        this.phone = phone;
        this.pickedup_address = pickedup_address;
        this.remark = remark;
    }
}