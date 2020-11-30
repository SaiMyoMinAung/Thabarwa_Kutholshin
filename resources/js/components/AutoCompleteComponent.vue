<template>
  <div>
    <div v-if="selected != null">
      <img
        :src="selected.logo"
        class="img-thumbnail float-left mr-3"
        style="width: 100px; height: 100px"
        alt="Logo"
      />
      <p>
        I would like to donate <span class="h3">{{ selected.name }}. </span>
      </p>
    </div>

    <cool-select
      v-bind:value="selected"
      v-on:input="selectedItem($event)"
      :items="items"
      :loading="loading"
      :error-message="errorMessage"
      :inputElCustomAttributes="customAtt"
      :successful="!!(!errorMessage && selected)"
      item-text="name"
      placeholder="Fill About Item"
      disable-filtering-by-search
      @search="onSearch"
      @blur="blur($event)"
    >
      <template slot="input-end">
        <span v-if="selected || errorMessage" style="margin-right: 8px">
          {{ errorMessage ? "❌" : "✔️" }}
        </span>
      </template>

      <template #no-data>
        {{
          noData
            ? "No information found by request."
            : "You Can Donate Whatever You Want."
        }}
      </template>
      <template #item="{ item }">
        <div class="item" v-if="item.logo && item.name">
          <img :src="item.logo" class="logo" />

          <div>
            <span class="item-name"> {{ item.name }} </span> <br />
            <!-- <span class="item-domain"> {{ item.domain }} </span> -->
          </div>
        </div>
      </template>
      <template v-if="loading" #input-end>
        <!-- You can use your own loading spinner -->
        <img
          src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif?cid=ecf05e47tucuntr2wy3dv28679rzb91h2y0ddnzrzmqml56x&rid=giphy.gifI"
          class="loading-indicator"
        />
      </template>
    </cool-select>
  </div>
</template>

<script>
import { CoolSelect } from "vue-cool-select";

export default {
  components: {
    CoolSelect,
  },
  data: () => ({
    selected: null,
    disabled: true,
    items: [],
    loading: false,
    timeoutId: null,
    noData: false,
    errorMessage: null,
    customAtt: { maxlength: 100 },
  }),
  created() {
    this.$root.$on("aboutItemInputHasError", (data) => {
      this.errorMessage = data;
    });
  },
  beforeDestroy() {
    this.$root.$off("aboutItemInputHasError");
  },
  methods: {
    blur() {
      if (this.selected == null) {
        this.validate("");
      }
    },
    validate(val) {
      if (
        val.length >= this.maxlength - (this.maxlength - 5) &&
        val.length <= this.maxlength - 1
      ) {
        // this.state = true;
        this.errorMessage = null;
      } else if (val.length >= this.maxlength) {
        // this.state = false;
        this.errorMessage = "Too Long!";
      } else if (val.length <= this.maxlength - (this.maxlength - 5)) {
        this.errorMessage = "About Item Required!";
      } else {
        this.errorMessage = null;
        // this.successMessage = "";
      }
    },
    selectedItem($event) {
      console.log($event);
      if ($event != null) {
        this.selected = $event;
        this.$emit("selectedItem", $event.name);
      }
    },
    async onSearch(search) {
      const lettersLimit = 2;

      this.noData = false;

      if (this.selected != null && search != this.selected.name) {
        this.selected = null;
      }

      if (search.length < lettersLimit) {
        this.items = [];
        this.loading = false;
        this.selected = null;
        this.$emit("selectedItem", null);
        return;
      }

      this.validate(search);

      // if (search.length >= 100) {
      //   this.items = [];
      //   this.loading = false;
      //   return;
      // }
      this.loading = true;

      clearTimeout(this.timeoutId);
      this.timeoutId = setTimeout(async () => {
        const response = await fetch(
          // `https://autocomplete.clearbit.com/v1/companies/suggest?query="${search}"`
          "http://127.0.0.1:8000/get_auto_complete_data"
        );

        this.items = await response.json();
        this.loading = false;

        if (!this.items.length) {
          this.noData = true;
          this.items = [
            {
              name: search,
              logo:
                "data:image/jpeg;base64,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",
            },
          ];
        }

        console.log(this.items);
      }, 500);
    },
  },
};
</script>

<style>
.item {
  display: flex;
  align-items: center;
}

.item-name {
  font-size: 25px;
}
.item-domain {
  color: grey;
}

.logo {
  max-width: 60px;
  margin-right: 10px;
  border: 1px solid #eaecf0;
}

.loading-indicator {
  width: 20px;
  margin-right: 10px;
}
</style>
