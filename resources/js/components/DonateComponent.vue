<template>
  <div>
    <b-card-group deck>
      <b-card
        border-variant="primary"
        header="Fill Donation Information"
        header-text-variant="black"
      >
        <b-card-body>
          <!-- #1 donation form logic -->
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
              @blur="nameInput.validateName($event)"
              placeholder="Fill Name"
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
              @blur="emailInput.isEmail($event)"
              placeholder="Fill Email (Optional)"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end email input -->

          <!-- start phone input -->
          <b-form-group
            id="phone"
            label-cols-sm="3"
            label-for="phone"
            :state="phoneInput.state"
            :valid-feedback="phoneInput.successMessage"
            :invalid-feedback="phoneInput.errorMessage"
          >
            <template v-slot:label>
              Phone
              <span class="text-danger">*</span>
            </template>
            <b-form-input
              id="phone"
              v-model="donation.phone"
              :state="phoneInput.state"
              :maxlength="phoneInput.maxlength"
              placeholder="09 - xxxxxxxxx"
              @input="phoneInput.validatePhone($event)"
              @blur="phoneInput.validatePhone($event)"
              @keypress="phoneInput.isNumber($event)"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end phone input -->

          <!-- start pickedup info -->
          <b-form-group
            id="pickedup_address"
            label-cols-sm="3"
            label-for="pickedup_address"
            :state="pickedUpAddressInput.state"
            :valid-feedback="pickedUpAddressInput.successMessage"
            :invalid-feedback="pickedUpAddressInput.errorMessage"
          >
            <template v-slot:label>
              Pick Up Address
              <span class="text-danger">*</span>
            </template>
            <b-form-textarea
              id="pickedup_address"
              v-model="donation.pickedup_address"
              placeholder="Fill Pick Up Address"
              :state="pickedUpAddressInput.state"
              :maxlength="pickedUpAddressInput.maxlength"
              @input="pickedUpAddressInput.validateAddress($event)"
              @blur="pickedUpAddressInput.validateAddress($event)"
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
          <!-- end pickedup info -->
          <!-- start remark info -->
          <RemarkEditor v-model="donation.remark"></RemarkEditor>
          <!-- end remark info -->
          
        </b-card-body>
      </b-card>
    </b-card-group>
  </div>
</template>

<script>
import donation from "../models/donation.js";
import nameInput from "../default_props_and_fns/name_input.js";
import emailInput from "../default_props_and_fns/email_input.js";
import phoneInput from "../default_props_and_fns/phone_input.js";
import pickedUpAddressInput from "../default_props_and_fns/pickedup_address_input.js";
import RemarkEditor from "../inputs/RemarkEditor";

export default {
  data: () => ({
    donation: new donation(),
    nameInput: new nameInput(),
    emailInput: new emailInput(),
    phoneInput: new phoneInput(),
    pickedUpAddressInput: new pickedUpAddressInput()
  }),
  methods: {},
  components: {
    RemarkEditor
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
