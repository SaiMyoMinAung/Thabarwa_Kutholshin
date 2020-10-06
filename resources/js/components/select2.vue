<template>
  <div>
    <v-select
      label="name"
      :loading="loading"
      :filterable="false"
      :options="options"
      @search="onSearch"
      @input="userSelected($event)"
      ref="select2"
      :value="(selectedOption === null) ? value : selectedOption"
    >
      <template slot="no-options">{{ placeholder }}</template>
      <template slot="option" slot-scope="option">
        <div class="d-center">
          <!-- <img :src="option.owner.avatar_url" /> -->
          {{ option.name }}
        </div>
      </template>
      <template slot="selected-option" slot-scope="option">
        <div class="selected d-center">
          <!-- <img :src="option.owner.avatar_url" /> -->
          {{ option.name }}
        </div>
      </template>
      <li slot="list-footer" class="pagination">
        <button @click="previous()" :disabled="!hasPrevPage">Prev</button>
        <button @click="next()" :disabled="!hasNextPage">Next</button>
      </li>
    </v-select>
  </div>
</template>
<style scoped>
img {
  height: auto;
  max-width: 2.5rem;
  margin-right: 1rem;
}

.d-center {
  display: flex;
  align-items: center;
}

.selected img {
  width: auto;
  max-height: 23px;
  margin-right: 0.5rem;
}

.v-select .dropdown li {
  border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
  border-bottom: none;
}

.v-select .dropdown li a {
  padding: 10px 20px;
  width: 100%;
  font-size: 1.25em;
  color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
  color: #fff;
}

.pagination {
  display: flex;
  margin: 0.25rem 0.25rem 0;
}
.pagination button {
  flex-grow: 1;
}
.pagination button:hover {
  cursor: pointer;
}
</style>

<script>
export default {
  props: ["value", "selectedOption", "url", "placeholder"],
  data: () => ({
    options: [],
    page: 1,
    q: "",
    loading: false,
    hasPrevPage: "",
    hasNextPage: ""
  }),
  watch: {
    value: function(val) {
      console.log(val);
      if (val === null) {
        this.$refs.select2.clearSelection();
      }
      if (this.selectedOption != null) {
        this.options = [];
        this.options.push(this.selectedOption);
      }
    }
  },
  methods: {
    userSelected($event) {
      this.$emit("input", $event);
    },
    previous() {
      this.page -= 1;
      this.loading = true;
      this.fetchData();
    },
    next() {
      this.page += 1;
      this.loading = true;
      this.fetchData();
    },
    onSearch(search, loading) {
      this.loading = true;
      this.search(loading, search, this);
    },
    search: _.debounce((loading, search, vm) => {
      vm.q = search;
      vm.loading = true;
      vm.fetchData();
    }, 350),
    fetchData() {
      var self = this;
      fetch(this.url + `?q=${escape(this.q)}&page=${this.page}`)
        .then(res => {
          res.json().then(json => {
            self.options = json.data;
            self.page = json.current_page;
            self.hasPrevPage = json.prev_page_url;
            self.hasNextPage = json.next_page_url;
          });
          self.loading = false;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    this.fetchData();
  }
};
</script>