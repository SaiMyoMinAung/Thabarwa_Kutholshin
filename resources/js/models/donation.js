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
        this.recaptcha = '';
        this.country_id = null;
        this.state_region_id = null;
        this.city_id = null;

    }

    getDonationFormData() {
        var donationFormData = new FormData();
        donationFormData.append('about_item', this.about_item);
        donationFormData.append('name', this.name);
        donationFormData.append('email', this.email);
        donationFormData.append('phone', this.phone);
        donationFormData.append('pickedup_address', this.pickedup_address);
        donationFormData.append('remark', this.remark);
        donationFormData.append('pickedup_at', this.pickedup_at);
        donationFormData.append('recaptcha', this.recaptcha);
        if (this.country_id != null) {
            donationFormData.append('country_id', this.country_id);
        }
        if (this.state_region_id != null) {
            donationFormData.append('state_region_id', this.state_region_id);
        }
        if (this.city_id != null) {
            donationFormData.append('city_id', this.city_id);
        }

        if (this.image != null) {
            for (var i = 0; i < this.image.length; i++) {
                let image = this.image[i];
                donationFormData.append('image[' + i + ']', image);
            }
        }

        return donationFormData;
    }
}