"use strict";

const group1 = document.getElementById("group1");
const group2 = document.getElementById("group2");
const group3 = document.getElementById("group3");
const group4 = document.getElementById("group4");
const groups = ['group1','group2','group3','group4']
const sortableSpeed = 150;

const sortable1 = Sortable.create(group1, {
  group: {
    name: "group1",
    put: groups
  },
  cursor: 'move',
  animation: sortableSpeed,

  onMove: function(evt) {
    const dropGroup = evt.to;
    group2.classList.add("adding");
  },
  onSort: function(evt) {
    console.log("group1 on sort");
    evt.from.classList.remove("adding");
  },
  onEnd: function(evt) {
    group2.classList.remove("adding");
  },
  filter: ".remove",
  onFilter: function(evt) {
    const item = evt.item,
      ctrl = evt.target;
    if (Sortable.utils.is(ctrl, ".remove")) {
      // Click on remove button
      $(item).slideUp('400', function() {
         $(item).remove();
      });
    }
  }
});

const sortable2 = Sortable.create(group2, {
  group: {
    name: "group2",
    put: groups
  },
  cursor: 'move',
  animation: sortableSpeed,

  onSort: function(evt) {
    evt.to.classList.remove("adding");
  }
});

const sortable3 = Sortable.create(group3, {
  group: {
    name: "group3",
    put: groups
  },
  cursor: 'move',
  animation: sortableSpeed,
  onMove: function(evt) {
    const dropGroup = evt.to;
    dropGroup.classList.add("adding");
    evt.from.classList.remove("adding");
  },
  onSort: function(evt) {
    evt.from.classList.remove("adding");
  },
  onEnd: function(evt) {
    document.getElementById("group2").classList.remove("adding");
  }
});

const sortable4 = Sortable.create(group4, {
  group: {
    name: "group4",
    put: groups
  },
  cursor: 'move',
  animation: sortableSpeed,
  onMove: function(evt) {
    const dropGroup = evt.to;
    dropGroup.classList.add("adding");
    evt.from.classList.remove("adding");
  },
  onSort: function(evt) {
    evt.from.classList.remove("adding");
  },
  onEnd: function(evt) {
    document.getElementById("group2").classList.remove("adding");
  }
});

if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector;
}