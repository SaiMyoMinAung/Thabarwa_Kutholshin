import ShareInternalDonatedItemValidation from "../../validations/internal_donated_item_component/create_share_internal_donated_item_validation";

export default class ShareInternalDonatedItem {
    constructor(share_internal_donated_item) {
        this.listOfRequest = {};
        this.data = {
            uuid: "",
            item_type_id: "",
            item_sub_type_id: "",
            socket_qty: "",
            requestable_type: "",
            requestable_id: "",
        };

        // url
        this.createShareInternalDonatedItemUrl = route('share_internal_donated_items.create');
        this.shareInternalDonatedItemIndexUrl = route('share_internal_donated_items.index');
        this.getRequestableTypeUrl = route('requestable_types.fetch');
        this.getRequestableTypeIdUrl = "";

        this.ShareInternalDonatedItemSubmited = false;
        this.ShareInternalDonatedItemValidation = new ShareInternalDonatedItemValidation();
        // selected
        this.selectedItemType = null;
        this.selectedItemSubType = null;
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        // fetch 
        this.itemSubTypeFetch = 0;
        this.RequestablePersonFetch = 0;
        // route
        this.fetchItemType = route('item_types.fetch');
        this.fetchItemSubType = "";

        if (share_internal_donated_item != undefined || share_internal_donated_item != null) {
            this.constructData(share_internal_donated_item)
        }

    }
    blankData() {
        this.uuid = "";
        this.item_type_id = "";
        this.item_sub_type_id = "";
        this.requestable_type = "";
        this.requestable_id = "";
        this.socket_qty = "";
        this.selectedItemType = null;
        this.selectedItemSubType = null;
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        this.ShareInternalRequestedItemSubmited = false;
    }
    constructData(share_internal_donated_item) {

        this.data.uuid = share_internal_donated_item.uuid;
        this.data.item_type_id = share_internal_donated_item.item_type_id;
        this.data.item_sub_type_id = share_internal_donated_item.item_sub_type_id;
        this.data.socket_qty = share_internal_donated_item.socket_qty;
        this.data.requestable_type = share_internal_donated_item.requestable_type;
        this.data.requestable_id = share_internal_donated_item.requestable_id;

        this.ShareInternalDonatedItemSubmited = false;

        this.selectedItemType = share_internal_donated_item.selectedItemType;
        this.selectedItemSubType = share_internal_donated_item.selectedItemSubType;
        this.selectedRequestableType = share_internal_donated_item.selectedRequestableType;
        this.selectedRequestableTypeId = share_internal_donated_item.selectedRequestableTypeId;

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

    selectedItemTypeBox(event) {
        this.selectedItemType = event;
        this.data.item_type_id = event != null ? event.id : "";
        this.fetchItemSubType = route('item_sub_types.fetch') + this.data.item_type_id;
        this.data.item_sub_type_id = "";
        this.selectedItemSubType = null;
        this.itemSubTypeFetch++;
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
            this.getRequestableTypeIdUrl = route('teams.fetch');
        } else if (event.id === "USER") {
            this.getRequestableTypeIdUrl = route('users.fetch');
        } else if (event.id === "YOGI") {
            this.getRequestableTypeIdUrl = route('yogis.fetch');
        } else if (event.id === "UNEXPECTED_PERSON") {
            this.getRequestableTypeIdUrl = route('unexpected_persons.fetch');
        }
        this.RequestablePersonFetch++;

        window.dashboard_app.$emit('clearSelect2Options', { placeholder: 'Select Requestable Person' });
    }

    selectedRequestableTypeIdBox(event) {
        this.selectedRequestableTypeId = event;
        this.data.requestable_id = event != null ? event.id : "";
    }

}