<template>
  <div class="row">
    <div class="col-sm-7">
      <div class="card">
        <div class="card-header">Bookings</div>
        <div class="card-body">
          <v-client-table :data="bookings" :columns="bookings_columns">
            <span slot="name" slot-scope="{row}">{{ row.projector.name}}</span>
            <span slot="serial" slot-scope="{row}">{{ row.projector.serial}}</span>
            <span slot="approved" slot-scope="{row}">{{ row.approved.name}}</span>
            <span slot="returned" slot-scope="{row}">
                {{ row.return_to?'returned':'not returned' }}
            </span>
            <span slot="action" slot-scope="{row}" :key="row.id">
              <div class="dropdown">
                <a
                  class="btn btn-sm btn-icon-only text-light"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <span
                    class="dropdown-item"
                    @click="selectedBooking=row"
                  >
                  <form :action="'booking/'+row.id" method="post">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="btn btn-link" type="submit">
                        Recieve
                    </button>
                  </form>
                  </span>
                </div>
              </div>
            </span>
          </v-client-table>
        </div>
      </div>
    </div>
    <div class="col-sm-5" >
      <div class="card">
        <div class="card-header">Projectors</div>
        <div class="card-body">
          <v-client-table v-if="filteredProjectors" :data="filteredProjectors" :columns="columns">
            <span slot="department" slot-scope="{row}">{{ row.department?row.department.name :''}}</span>
            <span slot="action" slot-scope="{row}" :key="row.id">
              <div class="dropdown">
                <a
                  class="btn btn-sm btn-icon-only text-light"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a
                    class="dropdown-item"
                    @click="selectedProjector=row"
                    data-toggle="modal"
                    data-target="#book"
                  >Book</a>
                </div>
              </div>
            </span>
          </v-client-table>


          <div
            class="modal modal-black fade"
            id="book"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-footer">
                  <h5 class="modal-title">
                    Assign:
                    <strong>{{ selectedProjector?selectedProjector.name+': '+selectedProjector.serial:'' }}</strong>
                  </h5>
                  <h5 class="modal-title">
                    To:
                    <strong>{{ selectedStaff?selectedStaff.name:'' }}</strong>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/booking" id="myForm" method="post">
                  <div class="modal-body">
                    <input type="hidden" name="_token" :value="csrf" />
                    <input
                      type="hidden"
                      name="user_id"
                      v-if="selectedStaff"
                      v-model="selectedStaff.id"
                    />
                    <input
                      type="hidden"
                      name="projector_id"
                      v-if="selectedProjector"
                      v-model="selectedProjector.id"
                    />
                    <v-client-table :data="staff" :columns="staff_columns">
                      <span slot="action" slot-scope="{row}">
                        <button class="btn btn-sm" type="button" @click="selectedStaff=row">select</button>
                      </span>
                    </v-client-table>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary">Asign</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["projectors", "staff", "bookings"],
  mounted() {
    console.log(this.projectors);
    this.filteredProjectors = this.projectors.filter(projector => {
      return !projector.is_booked;
    });
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      columns: ["name", "serial", "department", "action"],
      bookings_columns: ["name", "serial", "approved", "returned", "action"],
      staff_columns: ["name", "action"],
      filteredProjectors: null,
      selectedProjector: null,
      selectedStaff: null,
      selectedBooking: null
    };
  }
};
</script>

<style>
</style>
