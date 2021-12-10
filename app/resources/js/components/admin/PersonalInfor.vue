<template>
  <div class="content">
    <div style="display: flex">
      <personal-form
        :staff="staff"
        style="margin: 20px; width: 60%"
      ></personal-form>
      <user-card :staff="staff" style="margin: 20px; width: 40%"></user-card>
    </div>
  </div>
</template>
<script>
import PersonalForm from "./personal_components/PersonalForm.vue";
import UserCard from "./personal_components/UserCard.vue";
export default {
  components: {
    PersonalForm,
    UserCard,
  },
  beforeMount() {
    let user = JSON.parse(localStorage.getItem("bigStore.user"));
    axios.get(`/api/getStaffs/${user.email}`).then((response) => {
      this.staff = response.data;
      console.log(response.data);
    });
  },
  data() {
    return {
      staff: [],
    };
  },
};
</script>

