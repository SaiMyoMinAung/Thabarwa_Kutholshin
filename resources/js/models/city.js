export default class city {
    constructor(
        name = '',
        is_available = 0,
    ){
        this.list = '';
        this.validation = null;
        this.isSuccess = '';
        this.name = name;
        this.is_available = is_available;
        this.isLoading = false;
        this.fetchCity()
    }

    fetchCity() {
        axios
          .get("/backend/cities")
          .then(response => (this.list = response.data.data));
    }

    createCity() {   
        var self = this;
        this.isLoading = true
        
        var data = {name:this.name,is_available:this.is_available};
        axios.post("/backend/cities", data)
            .then(response => {
                this.list.unshift(response.data);
                this.isLoading = false;
                this.isSuccess = true;
                this.clearData();
                this.validation = null;
                var drop_down_item = $('.dropdown-menu a[href="#city-list"]');
                drop_down_item.tab('show');
                drop_down_item.parent().parent()[0].childNodes[0].text = drop_down_item.text();
            })
            .catch(function (error) {
                self.isLoading = false
                self.isSuccess = false;
                self.validation = error.response.data.errors;
            });
    }

    clearData() {
        this.name = '';
        this.is_available = 0;
    }
}