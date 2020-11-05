export default class countryInput {
    constructor() {
        this.url = route('getCountries');
        this.placeholder = 'Type To Search Country';
        this.disabled = false;
        this.country_id = '';
        this.country = '';
        this.fetch = '';
    }

}