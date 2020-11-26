import step1validation from './step1validation';
import step2validation from './step2validation';

export default class NewManage {
    constructor() {

        this.requested_item = {
            uuid: null,
            request_no: null,
            qty: null,
            status: null,
            delivered_volunteer: null,
            delivered_volunteer_id: null,
            user: {
                name: null,
            },
        };

        this.step1 = {
            validation: new step1validation(),
            delivered_volunteer: null,
            data: {
                delivered_volunteer_id: null,
            },
            deliveredVolunteerPlaceholder: "Type To Search Delivered Volunteers...",
            deliveredVolunteerUrl: route("volunteers.get_delivered_volunteers"),
        };
        this.step2 = {
            validation: new step2validation(),
        };

    }

    selectedDeliveredVolunteer(event) {
        this.step1.delivered_volunteer = event;
        this.step1.data.delivered_volunteer_id = event != null ? event.id : "";
    }

    changeCompleteState() {

        var self = this;
        var url = route('requestedItem.changeCompleteState', this.requested_item.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.get(url, this.step1.data)
            .then(response => {
                console.log(response)
                self.step2.validation = new step2validation()
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.step2.validation = new step2validation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    changeIncompleteState() {
        var self = this;
        var url = route('requestedItem.changeInCompleteState', this.requested_item.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.get(url, this.step1.data)
            .then(response => {
                console.log(response)
                self.step2.validation = new step2validation()
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.step2.validation = new step2validation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    assignDeliveredVolunteer() {
        var self = this;
        var url = route('requestedItem.assignDeliver', this.requested_item.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.post(url, this.step1.data)
            .then(response => {
                console.log(response)
                self.step1.validation = new step1validation()
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                console.log(error.response)
                self.step1.validation = new step1validation(error.response.data.errors)
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });

    }

    changeDeliveringState() {
        var url = route('requestedItem.changeDeliveringState', this.requested_item.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.get(url)
            .then(response => {
                console.log(response)
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }

    changeDoneDeliveringState() {
        var url = route('requestedItem.changeDoneDeliveringState', this.requested_item.uuid);

        window.dashboard_app.$emit('startLoading');

        axios.get(url)
            .then(response => {
                console.log(response)
                window.dashboard_app.$emit('success', response.data)
                window.dashboard_app.$toasted.show("Saving Success.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            })
            .catch(function (error) {
                // window.dashboard_app.$emit('failed')
                window.dashboard_app.$toasted.show("Saving Failed.", { icon: "save" });
                window.dashboard_app.$emit('endLoading');
            });
    }


    constructData(manageRequestedItem) {
        Object.assign(this.requested_item, manageRequestedItem);
        this.step1.delivered_volunteer = manageRequestedItem.delivered_volunteer;
        this.step1.data.delivered_volunteer_id = manageRequestedItem.delivered_volunteer_id;
    }

}