import ShareInternalDonatedItemValidation from "../../validations/internal_donated_item_component/create_share_internal_donated_item_validation";

export default class ShareInternalDonatedItem {
    constructor(share_internal_donated_item) {
        this.listOfRequest = {};
        this.data = {
            uuid: "",
            item_sub_type_id: "",
            package_qty: 0,
            sacket_qty: 0,
            requestable_type: "",
            requestable_id: "",
            office_id: ""
        };
        // model
        this.showModel = "";

        // url
        this.createShareInternalDonatedItemUrl = route('share_internal_donated_items.create');
        this.shareInternalDonatedItemIndexUrl = route('share_internal_donated_items.index');
        this.getRequestableTypeUrl = route('requestable_types.fetch');
        this.getRequestableTypeIdUrl = "";

        this.ShareInternalDonatedItemSubmited = false;
        this.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation();
        // selected
        this.selectedItemSubType = null;
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        // fetch 
        this.itemSubTypeFetch = 0;
        this.RequestablePersonFetch = 0;
        // route
        this.fetchItemSubType = route('item_sub_types.fetch');

        if (share_internal_donated_item != undefined || share_internal_donated_item != null) {
            this.constructData(share_internal_donated_item)
        }

    }
    blankData() {
        this.uuid = "";
        this.item_sub_type_id = "";
        this.requestable_type = "";
        this.requestable_id = "";
        this.package_qty = "";
        this.sacket_qty = "";
        this.selectedItemSubType = null;
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        this.ShareInternalRequestedItemSubmited = false;
    }
    constructData(share_internal_donated_item) {

        if(share_internal_donated_item.uuid){
            this.data.uuid = share_internal_donated_item.uuid;
        }
        
        if(share_internal_donated_item.item_sub_type_id){
            this.data.item_sub_type_id = share_internal_donated_item.item_sub_type_id;
        }
        
        if(share_internal_donated_item.package_qty){
            this.data.package_qty = share_internal_donated_item.package_qty;
        }
        
        if(share_internal_donated_item.sacket_qty){
            this.data.sacket_qty = share_internal_donated_item.sacket_qty;
        }
        
        if(share_internal_donated_item.requestable_type){
            this.data.requestable_type = share_internal_donated_item.requestable_type;
        }
        
        if(share_internal_donated_item.requestable_id){
            this.data.requestable_id = share_internal_donated_item.requestable_id;
        }

        if(share_internal_donated_item.getRequestableTypeIdUrl){
            this.getRequestableTypeIdUrl = share_internal_donated_item.getRequestableTypeIdUrl
        }

        if(share_internal_donated_item.showModel){
            this.showModel = share_internal_donated_item.showModel
        }
        
        this.ShareInternalDonatedItemSubmited = false;

        if(share_internal_donated_item.selectedItemSubType){
            this.selectedItemSubType = share_internal_donated_item.selectedItemSubType;    
        }

        if(share_internal_donated_item.selectedRequestableType) {
            this.selectedRequestableType = share_internal_donated_item.selectedRequestableType;
        }
        
        if(share_internal_donated_item.selectedRequestableTypeId) {
            this.selectedRequestableTypeId = share_internal_donated_item.selectedRequestableTypeId;
        }
        

    }

    saveShare() {

        this.ShareInternalDonatedItemSubmited = true;

        let self = this;

        let url = route('share_internal_donated_items.store')

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.data)
            .then(response => {
                this.ShareInternalDonatedItemSubmited = false;
                this.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation()
                // construct with new data
                this.constructData(response.data);
                // To Reload The Store List
                window.dashboard_app.$emit('successfulSaveShare', response.data);
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response.data.errors)
                self.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });

    }

    updateShare() {
        let self = this;
        let data = this.data;
        data['_method'] = 'PATCH';
        let url = route('share_internal_donated_items.update', this.data.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.data)
            .then(response => {
                // clear validation
                this.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation()
                // construct with new data
                this.constructData(response.data);
                // To Reload The Store List
                window.dashboard_app.$emit('successfulSaveShare', response.data);
                // send event
                window.dashboard_app.$emit('success', response.data)
                // do loading
                window.dashboard_app.$emit('endLoading');
                // do toast
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.history.pushState({}, '', route('share_internal_donated_items.edit', this.data.uuid));

            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation(error.response.data.errors)
                // do toast
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                // do loading
                window.dashboard_app.$emit('endLoading');
            });

    }

    selectedItemSubTypeBox(event) {
        this.selectedItemSubType = event;
        this.data.item_sub_type_id = event != null ? event.id : "";
    }

    selectedRequestableTypeBox(event) {
        this.selectedRequestableType = event;
        this.data.requestable_type = event != null ? event.id : "";
        // if changed requestable type, clear requestable person
        this.data.requestable_id = "";
        this.selectedRequestableTypeId = null;

        if (event.id === "TEAM") {
            this.showModel = "#teamModel"
            this.getRequestableTypeIdUrl = route('teams.fetch');
        }
        //  else if (event.id === "USER") {
        //     this.getRequestableTypeIdUrl = route('users.fetch');
        // }
         else if (event.id === "YOGI") {
             this.showModel = "#yogiModel"
            this.getRequestableTypeIdUrl = route('yogis.fetch');
        } else if (event.id === "UNEXPECTEDPERSON") {
            this.showModel = "#unexpectedPersonModel"
            this.getRequestableTypeIdUrl = route('unexpected_persons.fetch');
        } else if (event.id === "CONTRIBUTION") {
            this.showModel = "#contributionModel"
            this.getRequestableTypeIdUrl = "";
        }else{
            this.showModel = ""
        }
        this.RequestablePersonFetch++;

        window.dashboard_app.$emit('clearSelect2Options', { placeholder: 'Select Requestable Person' });
    }

    selectedRequestableTypeIdBox(event) {
        this.selectedRequestableTypeId = event;
        this.data.requestable_id = event != null ? event.id : "";
    }

}