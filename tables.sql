-- create user ht with superuser login createdb password 'ht.2014';
-- Organizations
create table organizations(
  id serial primary key,
  name text not null,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Users
create table users(
  id serial primary key,
  username text not null,
  password varchar(35) not null,
  name text not null,
  lastname text not null,
  lastname_second text,
  email text not null,
  last_login timestamp,
  avatar_uri text,
  allowed boolean default true,
  intro boolean default false,
  organization_id int not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (organization_id) references organizations(id)
);
-- Workgroups
create table workgroups(
  id serial primary key,
  name text not null,
  open boolean not null default false,
  user_id integer not null,
  organization_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (organization_id) references organizations(id)
);
-- Statuses
create table statuses(
  id serial primary key,
  name text not null,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Projects
create table projects(
  id serial primary key,
  name text not null,
  description text,
  deadline timestamp,
  user_id integer not null,
  status_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (status_id) references statuses(id)
);
-- User_Workgroup
create table user_workgroup(
  id serial primary key,
  user_id integer not null,
  workgroup_id integer not null,
  authorized boolean not null default false,
  authorized_at timestamp,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (workgroup_id) references workgroups(id)
);
-- Project_Workgroup
create table project_workgroup(
  id serial primary key,
  project_id integer not null,
  workgroup_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (project_id) references projects(id),
  foreign key (workgroup_id) references workgroups(id)
);
-- Organization_Project
create table organization_project(
  id serial primary key,
  organization_id integer not null,
  project_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (organization_id) references organizations(id),
  foreign key (project_id) references projects(id)
);
-- Project_User
create table project_user(
  id serial primary key,
  user_id integer not null,
  project_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (project_id) references projects(id)
);
-- Disks
create table disks(
  id serial primary key,
  name text not null,
  type text not null,
  sector integer not null,
  sector_track integer not null,
  track_cylinder integer not null,
  cylinders integer not null,
  rpm integer not null,
  track_overhead integer not null,
  track_skew integer not null,
  cylinder_skew integer not null,
  limit_disk integer not null,
  short_disk text not null,
  long_disk text not null,
  regions text not null,
  manufacturer text not null,
  product_name text not null,
  display_name text not null,
  display_size integer not null,
  display_unit text not null,
  available boolean not null default false,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Controllers
create table controllers(
  id serial primary key,
  name text not null,
  type text not null,
  block_size integer not null,
  cache_size varchar(35),
  new_overhead integer not null,
  read_fence text not null,
  write_fence text not null,
  prefetching boolean not null default true,
  inmediate_report boolean not null default true,
  msg_size integer not null,
  available boolean not null default false,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Drives
create table drives(
  id serial primary key,
  name text not null,
  controller_id integer not null,
  disk_id integer not null,
  available boolean not null default false,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (controller_id) references controllers(id),
  foreign key (disk_id) references disks(id)
);
-- Networks
create table networks(
  id serial primary key,
  type text not null,
  latency text not null,
  bandwidth text not null,
  network text not null,
  available boolean not null default false,
  display_name text not null,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Distributions
create table distributions(
  id serial primary key,
  distributor text not null,
  type text not null,
  size integer not null,
  striping integer not null,
  overhead integer not null,
  max_requests integer not null,
  report boolean not null default true,
  done_size integer not null,
  available boolean not null default false,
  created_at timestamp not null,
  updated_at timestamp not null
);
-- Configurations
create table configurations(
  id serial primary key,
  short_name text,
  name text not null,
  striping integer not null,
  striping_unit varchar(5) not null,
  sas_size bigint not null,
  notes text,
  user_id integer not null,
  network_id integer not null,
  distribution_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (network_id) references networks(id),
  foreign key (distribution_id) references distributions(id)
);
-- Configuration_Drive
create table configuration_drive(
  id serial primary key,
  configuration_id integer not null,
  drive_id integer not null,
  quantity integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (configuration_id) references configurations(id),
  foreign key (drive_id) references drives(id)
);
-- Workloads
create table workloads(
  id serial primary key,
  name text not null,
  sas_size bigint not null,
  distribution varchar(45) not null,
  interarrival integer not null,
  request_size integer not null,
  read_ratio integer not null,
  concurrency integer not null,
  sample_size bigint not null,
  idle_time text,
  sequential text,
  mean_burst_size text,
  notes text,
  user_id integer not null,
  status_id integer not null,
  project_id integer,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (status_id) references statuses(id),
  foreign key (project_id) references projects(id)
);
-- Scenarios
create table scenarios(
  id serial primary key,
  type_sim text not null,
  user_id integer not null,
  configuration_id integer not null,
  workload_id integer not null,
  workgroup_id integer,
  project_id integer,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (configuration_id) references configurations(id),
  foreign key (workload_id) references workloads(id),
  foreign key (workgroup_id) references workgroups(id),
  foreign key (project_id) references projects(id)
);
-- Experiments
create table experiments(
  id serial primary key,
  type_sim text,
  finished_at timestamp,
  user_id integer not null,
  scenario_id integer not null,
  project_id integer,
  status_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (scenario_id) references scenarios(id),
  foreign key (project_id) references projects(id),
  foreign key (status_id) references statuses(id)
);
-- Messages
create table messages(
  id serial primary key,
  user_id integer not null,
  is_important boolean not null default false,
  subject text,
  content text,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id)
);
-- Message_User
create table message_user(
  id serial primary key,
  message_id integer not null,
  user_id integer not null,
  is_read boolean not null default false,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (message_id) references messages(id),
  foreign key (user_id) references users(id)
);
-- Tasks
create table tasks(
  id serial primary key,
  title text not null,
  description text,
  start_t timestamp not null,
  end_t timestamp,
  is_finished boolean not null default false,
  parent integer,
  user_id integer not null,
  project_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (user_id) references users(id),
  foreign key (parent) references tasks(id)
);
-- Task_User
create table task_user(
  id serial primary key,
  task_id integer not null,
  user_id integer not null,
  created_at timestamp not null,
  updated_at timestamp not null,
  foreign key (task_id) references tasks(id),
  foreign key (user_id) references users(id)
);
