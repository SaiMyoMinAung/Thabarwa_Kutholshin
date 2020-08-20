<template>
  <div>
    <b-card-group deck>
      <b-card
        border-variant="primary"
        header="Fill Donation Information"
        header-text-variant="black"
      >
        <b-card-body>
          <!-- start name input -->
          <b-form-group
            id="name"
            label-cols-sm="3"
            label-for="name"
            :state="nameInput.state"
            :valid-feedback="nameInput.successMessage"
            :invalid-feedback="nameInput.errorMessage"
          >
            <template v-slot:label>
              Name
              <span class="text-danger">*</span>
            </template>
            <b-form-input
              id="name"
              v-model="donation.name"
              :state="nameInput.state"
              :maxlength="nameInput.maxlength"
              @input="nameInput.validateName($event)"
              placeholder="Enter Name"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end name input -->

          <!-- start email input -->
          <b-form-group
            id="email"
            label-cols-sm="3"
            label-for="email"
            :state="emailInput.state"
            :valid-feedback="emailInput.successMessage"
            :invalid-feedback="emailInput.errorMessage"
          >
            <template v-slot:label>Email</template>
            <b-form-input
              id="email"
              v-model="donation.email"
              :state="emailInput.state"
              :maxlength="emailInput.maxlength"
              @input="emailInput.validateEmail($event)"
              placeholder="Enter Email (Optional)"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end email input -->
        </b-card-body>
      </b-card>
    </b-card-group>
  </div>
</template>

<script>
import donation from "../models/donation.js";
import nameInput from "../default_props_and_fns/name_input.js";
import emailInput from "../default_props_and_fns/email_input.js";

export default {
  data: () => ({
    donation: new donation(),
    nameInput: new nameInput(),
    emailInput: new emailInput()
  }),
  methods: {},
  components: {},
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
