-- create user ht with superuser login createdb password 'ht.2014';
-- Organizations
create table organizations(
  id serial primary key,
  name text not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
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
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (organization_id) references organizations(id)
);
-- Workgroups
create table workgroups(
  id serial primary key,
  name text not null,
  open boolean not null default false,
  user_id integer not null,
  organization_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (organization_id) references organizations(id)
);
-- Statuses
create table statuses(
  id serial primary key,
  name text not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
);
-- Projects
create table projects(
  id serial primary key,
  name text not null default '',
  description text default '',
  deadline timestamp default null,
  user_id integer not null,
  status_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
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
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (workgroup_id) references workgroups(id)
);
-- Project_Workgroup
create table project_workgroup(
  id serial primary key,
  project_id integer not null,
  workgroup_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (project_id) references projects(id),
  foreign key (workgroup_id) references workgroups(id)
);
-- Organization_Project
create table organization_project(
  id serial primary key,
  organization_id integer not null,
  project_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (organization_id) references organizations(id),
  foreign key (project_id) references projects(id)
);
-- Project_User
create table project_user(
  id serial primary key,
  user_id integer not null,
  project_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),t
  foreign key (project_id) references projects(id)
);
-- Disks
create table disks(
  id serial primary key,
  name text not null default 'None',
  type text not null default 'WILKES_DISK',
  sector integer not null default 512,
  sector_track integer not null default 999,
  track_cylinder integer not null default 999,
  cylinders integer not null default 999,
  rpm integer not null default 999,
  track_overhead integer not null default 999,
  track_skew integer not null default 999,
  cylinder_skew integer not null default 999,
  limit_disk integer not null default 999,
  short_disk text not null default 'None',
  long_disk text not null default 'None',
  regions text not null default '0:0 0:0',
  manufacturer text not null default 'None',
  product_name text not null default 'None',
  display_name text not null default 'None',
  display_size integer not null default 999,
  display_unit text not null default 'None',
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
);
-- Controllers
create table controllers(
  id serial primary key,
  name text not null default 'None',
  type text not null default 'SIMPLE_CONTROLLER',
  block_size integer not null default 512,
  cache_size varchar(35) default '512 Kbytes',
  new_overhead integer not null default 999,
  read_fence text not null default '64 Kbytes',
  write_fence text not null default '64 Kbytes',
  prefetching boolean not null default true,
  inmediate_report boolean not null default true,
  msg_size integer not null default 1,
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
);
-- Drives
create table drives(
  id serial primary key,
  name text not null default 'None',
  controller_id integer not null,
  disk_id integer not null,
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (controller_id) references controllers(id),
  foreign key (disk_id) references disks(id)
);
-- Networks
create table networks(
  id serial primary key,
  type text not null default 'None',
  latency integer not null default 999,
  bandwidth text not null default 'None',
  network text not null default 'BUS',
  display_name text not null default 'None',
  display_order integer not null default 999,
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
);
-- Distributions
create table distributions(
  id serial primary key,
  name text not null default 'None',
  display_order integer not null default 999,
  is_trace_generator boolean not null default false,
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now()
);
-- Distributors
create table distributors(
  id serial primary key,
  distributor text not null default 'NODE0',
  type text not null default 'None',
  size integer not null default 10,
  striping integer not null default 999,
  overhead integer not null default 999,
  max_requests integer not null default 10,
  report boolean not null default true,
  done_size integer not null default 1,
  display_name text not null default 'None',
  display_order integer not null default 999,
  distribution_id integer not null,
  available boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (distribution_id) references distributions(id)
);
-- Configurations
create table configurations(
  id serial primary key,
  short_name text default '',
  striping integer not null default 128,
  striping_unit varchar(5) not null default 'KB',
  sas_size bigint not null default 999,
  notes text default '',
  user_id integer not null,
  network_id integer not null,
  distributor_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (network_id) references networks(id),
  foreign key (distributor_id) references distributors(id)
);
-- Configuration_Drive
create table configuration_drive(
  id serial primary key,
  configuration_id integer not null,
  drive_id integer not null,
  quantity integer not null default 999,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (configuration_id) references configurations(id),
  foreign key (drive_id) references drives(id)
);
-- Workloads
create table workloads(
  id serial primary key,
  sas_size bigint not null default 999,
  distribution varchar(45) not null default 'None',
  interarrival integer not null default 999,
  request_size integer not null default 999,
  read_ratio integer not null default 999,
  concurrency integer not null default 999,
  sample_size bigint not null default 999,
  idle_time text default null,
  sequential text default null,
  mean_burst_size text default null,
  notes text default '',
  user_id integer not null,
  status_id integer not null,
  project_id integer default null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (status_id) references statuses(id),
  foreign key (project_id) references projects(id)
);
-- Scenarios
create table scenarios(
  id serial primary key,
  type_sim text not null default 'None',
  user_id integer not null,
  configuration_id integer not null,
  workload_id integer not null,
  workgroup_id integer default null,
  project_id integer default null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (configuration_id) references configurations(id),
  foreign key (workload_id) references workloads(id),
  foreign key (workgroup_id) references workgroups(id),
  foreign key (project_id) references projects(id)
);
-- Experiments
create table experiments(
  id serial primary key,
  type_sim text default null,
  finished_at timestamp default null,
  user_id integer not null,
  scenario_id integer not null,
  project_id integer default null,
  status_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
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
  subject text default '',
  content text default '',
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id)
);
-- Message_User
create table message_user(
  id serial primary key,
  message_id integer not null,
  user_id integer not null,
  is_read boolean not null default false,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (message_id) references messages(id),
  foreign key (user_id) references users(id)
);
-- Tasks
create table tasks(
  id serial primary key,
  title text not null default '',
  description text default '',
  start_t timestamp not null default now(),
  end_t timestamp default null,
  is_finished boolean not null default false,
  parent integer default null,
  user_id integer not null,
  project_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (user_id) references users(id),
  foreign key (parent) references tasks(id)
);
-- Task_User
create table task_user(
  id serial primary key,
  task_id integer not null,
  user_id integer not null,
  created_at timestamp not null default now(),
  updated_at timestamp not null default now(),
  foreign key (task_id) references tasks(id),
  foreign key (user_id) references users(id)
);
