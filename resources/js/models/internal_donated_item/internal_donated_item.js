import InternalDonatedItemValidation from "./create_internal_donated_item_validation";

export default class InternalDonatedItem {
    constructor(internal_donated_item) {
        this.listOfRequest = {};
        this.data = {
            uuid: "",
            item_unique_id: "",
            alms_round_id: "",
            item_type_id: "",
            item_sub_type_id: "",
            package_qty: "",
            socket_qty: "",
            socket_per_package: "",
            unit_id: "",
            remark: "",
            is_confirmed: false,
            status: "",
        };
        this.requestData = {
            requestable_type: "",
            requestable_id: "",
            request_package_qty: "",
            request_socket_qty: ""
        };

        // url
        this.getRequestableTypeUrl = route('requestable_types.fetch');
        this.getRequestableTypeIdUrl = "";
        this.internalDonatedItemIndexUrl = route('internal_donated_items.index');
        this.internalDonatedItemCreateUrl = route('internal_donated_items.create');

        this.InternalRequestedItemSubmited = false;
        this.InternalDonatedItemSubmited = false;
        this.InternalDonatedItemValidation = new InternalDonatedItemValidation();
        // selected
        this.selectedAlmsRound = null;
        this.selectedItemType = null;
        this.selectedItemSubType = null;
        this.selectedUnit = null;
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        // fetch 
        this.itemSubTypeFetch = 0;
        // route
        this.fetchUnit = route('units.fetch');
        this.fetchItemType = route('item_types.fetch');
        this.fetchAlmsRound = route('alms_round.fetch');
        this.fetchItemSubType = "";
        if (internal_donated_item != undefined || internal_donated_item != null) {
            this.constructData(internal_donated_item)
        }

    }
    blankRequestData() {
        this.requestData.requestable_type = "";
        this.requestData.requestable_id = "";
        this.requestData.request_package_qty = "";
        this.requestData.request_socket_qty = "";
        this.selectedRequestableType = null;
        this.selectedRequestableTypeId = null;
        this.InternalRequestedItemSubmited = false;
    }
    constructData(internal_donated_item) {

        this.data.uuid = internal_donated_item.uuid;
        this.data.item_unique_id = internal_donated_item.item_unique_id;
        this.data.alms_round_id = internal_donated_item.alms_round_id;
        this.data.item_type_id = internal_donated_item.item_type_id;
        this.data.item_sub_type_id = internal_donated_item.item_sub_type_id;
        this.data.package_qty = internal_donated_item.package_qty;
        this.data.socket_qty = internal_donated_item.socket_qty;
        this.data.socket_per_package = internal_donated_item.socket_per_package;
        this.data.unit_id = internal_donated_item.unit_id;
        this.data.remark = internal_donated_item.remark;
        this.data.is_confirmed = internal_donated_item.is_confirmed;
        this.data.status = internal_donated_item.status;

        this.InternalDonatedItemSubmited = false;

        this.selectedAlmsRound = internal_donated_item.selectedAlmsRound;
        this.selectedItemType = internal_donated_item.selectedItemType;
        this.selectedItemSubType = internal_donated_item.selectedItemSubType;
        this.selectedUnit = internal_donated_item.selectedUnit;

    }

    deleteRequest(uuid) {
        let url = route('internal_requested_items.destroy', this.data.uuid) + uuid

        window.dashboard_app.$emit('startLoading');

        axios.delete(url)
            .then(response => {
                console.log(response)
                this.InternalDonatedItemValidation = new InternalDonatedItemValidation()
                this.getRequestResult()
                window.dashboard_app.$toasted.show("Delete Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                window.dashboard_app.$toasted.show("Delete Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    getRequestResult() {
        if (this.data.uuid === "") {
            return false;
        }
        let url = route('internal_requested_items.index', this.data.uuid)
        axios.get(url)
            .then(response => {
                console.log(response)
                // construct with new data
                this.listOfRequest = response.data;
                // do loading
                window.dashboard_app.$emit('endLoading');

            })
            .catch(function (error) {
                // do toast
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                // do loading
                window.dashboard_app.$emit('endLoading');
            });

    }


    confirmAndSaveItem() {
        this.data.is_confirmed = true;
        this.saveItem()
    }

    updateAndConfirm() {
        this.data.is_confirmed = true;
        this.updateItem()
    }

    saveRequest() {

        this.InternalRequestedItemSubmited = true;
        let self = this;

        let url = route('internal_requested_items.store', this.data.uuid)

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.requestData)
            .then(response => {
                console.log(response)
                this.InternalDonatedItemValidation = new InternalDonatedItemValidation()
                this.blankRequestData();
                this.getRequestResult()
                // construct with new data
                this.constructData(response.data);
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.InternalDonatedItemValidation = new InternalDonatedItemValidation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });

    }

    controlAvailable() {
        let url = route('control.available', this.data.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.get(url)
            .then(response => {
                // construct with new data
                this.constructData(response.data);
                // send event
                window.dashboard_app.$emit('success', response.data)
                // do loading
                window.dashboard_app.$emit('endLoading');
                // do toast
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });

            })
            .catch(function (error) {
                // do toast
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                // do loading
                window.dashboard_app.$emit('endLoading');
            });
    }
    updateItem() {
        let self = this;
        let data = this.data;
        data['_method'] = 'PATCH';
        let url = route('internal_donated_items.update', this.data.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.data)
            .then(response => {
                console.log(response)
                // clear validation
                this.InternalDonatedItemValidation = new InternalDonatedItemValidation()
                // construct with new data
                this.constructData(response.data);
                // send event
                window.dashboard_app.$emit('success', response.data)
                // do loading
                window.dashboard_app.$emit('endLoading');
                // do toast
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.history.pushState({}, '', route('internal_donated_items.edit', this.data.uuid));

            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.InternalDonatedItemValidation = new InternalDonatedItemValidation(error.response.data.errors)
                // do toast
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                // do loading
                window.dashboard_app.$emit('endLoading');
            });

    }
    saveItem() {
        this.InternalDonatedItemSubmited = true;
        var self = this;

        var url = route('internal_donated_items.store');

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.data)
            .then(response => {
                console.log(response)
                this.InternalDonatedItemValidation = new InternalDonatedItemValidation()
                this.constructData(response.data);
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.InternalDonatedItemValidation = new InternalDonatedItemValidation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });

        // this.data.is_confirmed = false;
    }

    selectedUnitBox(event) {
        this.selectedUnit = event;
        this.data.unit_id = event != null ? event.id : "";
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

    selectedAlmsRoundBox(event) {
        this.selectedAlmsRound = event;
        this.data.alms_round_id = event != null ? event.id : "";
    }

    selectedRequestableTypeBox(event) {
        this.selectedRequestableType = event;
        this.requestData.requestable_type = event != null ? event.id : "";

        if (event.id === "TEAM") {
            this.getRequestableTypeIdUrl = route('teams.fetch');
        } else if (event.id === "USER") {
            this.getRequestableTypeIdUrl = route('users.fetch');
        } else if (event.id === "YOGI") {
            this.getRequestableTypeIdUrl = route('yogis.fetch');
        } else if (event.id === "UNEXPECTED_PERSON") {
            this.getRequestableTypeIdUrl = route('unexpected_persons.fetch');
        }

        window.dashboard_app.$emit('clearSelect2Options', { placeholder: 'Select Requestable Person' });
    }

    selectedRequestableTypeIdBox(event) {
        this.selectedRequestableTypeId = event;
        this.requestData.requestable_id = event != null ? event.id : "";
    }

}