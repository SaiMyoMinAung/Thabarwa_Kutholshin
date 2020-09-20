export default class datePickerInput {
    constructor(
        state = null,
        successMessage = '',
        errorMessage = ''
        
    ){
        this.state = state;
        this.successMessage = successMessage;
        this.errorMessage = errorMessage;
    }
    
    valideDatePicker(val) {
        
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;

        
        var GivenDate = new Date(val);
        var dd = String(GivenDate.getDate()).padStart(2, '0');
        var mm = String(GivenDate.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = GivenDate.getFullYear();
        GivenDate = mm + '/' + dd + '/' + yyyy;

        console.log(GivenDate)
        console.log(today)
        if(val.length == 0){
            this.state = false;
            this.errorMessage = "Picked Up Date Required!";
        }else if(GivenDate >= today){
            this.state = true;
            this.successMessage = "Nice Picked Up Date.";
        }else if(GivenDate < today){
            this.state = false;
            this.errorMessage = "Picked Up Date Is Behind Today!";
        }
    }
}