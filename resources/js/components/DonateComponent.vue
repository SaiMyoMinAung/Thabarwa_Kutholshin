<template>
  <div class="mr-2">
    <b-card-group deck>
      <b-card
        border-variant="primary"
        header="Fill Donation Information"
        header-text-variant="black"
      >
        <b-card-body>
          <!-- start about item input -->
          <b-form-group
            id="about-item"
            label-cols-sm="3"
            label-for="name"
            :state="aboutItemInput.state"
            :valid-feedback="aboutItemInput.successMessage"
            :invalid-feedback="aboutItemInput.errorMessage"
          >
            <template v-slot:label>
              About Item
              <span class="text-danger">*</span>
            </template>
            <b-form-input
              id="about-item"
              v-model="donation.about_item"
              :state="aboutItemInput.state"
              :maxlength="aboutItemInput.maxlength"
              @input="aboutItemInput.validateAboutItem($event)"
              @blur="aboutItemInput.validateAboutItem($event)"
              placeholder="Fill About Item"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end about item input -->

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

          <!-- start date picker info -->
          <b-form-group
            label-cols-sm="3"
            label-for="pickedup_date"
            :state="datePickerInput.state"
            :valid-feedback="datePickerInput.successMessage"
            :invalid-feedback="datePickerInput.errorMessage"
          >
            <template v-slot:label>
              Choose a date
              <span class="text-danger">*</span>
            </template>
            <b-form-datepicker
              ref="dp1"
              :state="datePickerInput.state"
              :valid-feedback="datePickerInput.successMessage"
              :invalid-feedback="datePickerInput.errorMessage"
              v-model="donation.pickedup_at"
              @hidden="datePickerInput.valideDatePicker(donation.pickedup_at)"
              @focusin.native="onfocusin($event)"
              id="pickedup_date"
              class="mb-2"
            ></b-form-datepicker>
          </b-form-group>
          <!-- end date picker info -->

          <button class="offset-lg-3 offset-md-3 offset-sm-3 btn btn-success">Proceed Donate</button>

          <hr />

          <!-- start image -->
          <b-form-group
            label-cols-sm="3"
            label-for="image"
            :state="imageInput.state"
            :valid-feedback="imageInput.successMessage"
            :invalid-feedback="imageInput.errorMessage"
          >
            <template v-slot:label>
              Choose 3 Images
              <b-button variant="link" size="sm" @click="donation.image = null">Clear Images</b-button>
            </template>
            <b-form-file
              id="image"
              multiple
              :file-name-formatter="formatNames"
              accept=".jpg, .png, .gif, .jpeg"
              v-model="donation.image"
              :state="imageInput.state"
              @input="validateImage($event)"
              placeholder="Choose Image (Optional)"
              drop-placeholder="Drop file here..."
            >
              <template slot="file-name" slot-scope="{ names }">
                <b-badge variant="dark">{{ names[0] }}</b-badge>
                <b-badge
                  v-if="names.length > 1"
                  variant="dark"
                  class="ml-1"
                >+ {{ names.length - 1 }} More files</b-badge>
              </template>
            </b-form-file>
          </b-form-group>
          <!-- end image -->

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
              placeholder="Fill Email (Optional)"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- end email input -->

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
import aboutItemInput from "../default_props_and_fns/about_item_input.js";
import nameInput from "../default_props_and_fns/name_input.js";
import emailInput from "../default_props_and_fns/email_input.js";
import phoneInput from "../default_props_and_fns/phone_input.js";
import imageInput from "../default_props_and_fns/image_input.js";
import pickedUpAddressInput from "../default_props_and_fns/pickedup_address_input.js";
import datePickerInput from "../default_props_and_fns/date_picker_input.js";
import RemarkEditor from "../inputs/RemarkEditor";

export default {
  data: () => ({
    donation: new donation(),
    nameInput: new nameInput(),
    emailInput: new emailInput(),
    phoneInput: new phoneInput(),
    pickedUpAddressInput: new pickedUpAddressInput(),
    datePickerInput: new datePickerInput(),
    imageInput: new imageInput(),
    aboutItemInput: new aboutItemInput()
  }),
  methods: {
    onfocusin(event) {
      // need to develop
      console.log(event);
      console.log(this.$refs.dp1);
    },
    validateImage($event) {
      this.imageInput.validateImage($event);
    },
    formatNames(files) {
      if (files.length === 1) {
        return files[0].name;
      } else {
        return `${files.length} files selected`;
      }
    }
  },
  components: {
    RemarkEditor
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {}
};
</script>
