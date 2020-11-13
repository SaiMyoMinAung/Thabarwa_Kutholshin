import step2Validation from '../../validations/online_manage_component/step2'

export default class step2 {
    constructor(uuid = '') {
        this.uuid = uuid;
        // selected data
        this.store_keeper_volunteer = null;
        this.store = null;
        this.box = null;
        this.data = {
            store_keeper_volunteer_id: null,
            store_id: null,
            box_id: null
        }
        this.validation = new step2Validation;
        // url
        this.getVolunteerUrl = route("volunteers.get_store_keeper_volunteers")
        this.getStoreUrl = route("stores.auth")
        this.getBoxUrl = route("boxes.auth")
        // placeholder
        this.placeholder = "Type To Search Volunteer..."
        this.placeholderForStore = "Type To Search Store..."
        this.placeholderForBox = "Type To Search Box..."
        
    }

    assignStoreKeeper() {
        let self = this;
        let assignStoreKeeperApi = route("donatedItem.assignStoreKeeper", this.uuid);
        window.dashboard_app.$emit('startLoading');

        axios
            .post(assignStoreKeeperApi, this.data)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                this.validation = new step2Validation()
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
                self.validation = new step2Validation(error.response.data.errors);
            });
    }

    changeStoringState() {
        let changeStoringStateApi = route("donatedItem.changeStoringState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeStoringStateApi)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    changeDoneStoringState() {
        let changeDoneStoringStateApi = route("donatedItem.changeDoneStoringState", this.uuid);

        window.dashboard_app.$emit('startLoading');

        axios
            .get(changeDoneStoringStateApi)
            .then((response) => {
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    selectedStoreKeeperVolunteer(event) {
        this.store_keeper_volunteer = event;
        this.data.store_keeper_volunteer_id = event != null ? event.id : "";
    }

    selectedStore(event) {
        this.store = event;
        this.data.store_id = event != null ? event.id : "";
    }

    selectedBox(event) {
        this.box = event;
        this.data.box_id = event != null ? event.id : "";
    }

    constructData(model) {
        this.uuid = model.uuid
        this.store_keeper_volunteer = model.store_keeper_volunteer
        this.data.store_keeper_volunteer_id = model.store_keeper_volunteer_id
        this.store = model.store
        this.data.store_id = model.store_id
        this.box = model.box
        this.data.box_id = model.box_id
    }

}