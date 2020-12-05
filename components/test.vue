<template>
  <div>
    {{ msg }}

    <div v-for="(v, k) in lists" :key="k">
      <div>--- {{ k + " " + v }} ---</div>
    </div>
  </div>
</template>


<script>
(function ($) {
  Vue.component("vue-test", {
    data: function () {
      return {
        msg: "TEST",
        lists: ["a", "b", "c"],
      };
    },
    props: [],
    template: ``,
    created() {},
    computed: {},
    mounted() {},
    watch: {},
    methods: {},
  });
})(jQuery);
</script>



<style scoped>
</style>