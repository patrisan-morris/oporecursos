// resources/js/Utils/map.js
import LawIcon from '@/Components/Icons/Law.vue'
import NetworkIcon from '@/Components/Icons/Network.vue'
import SystemIcon from '@/Components/Icons/System.vue'
import DatabaseIcon from '@/Components/Icons/Database.vue'
import ProgramIcon from '@/Components/Icons/Program.vue'
import WireIcon from '@/Components/Icons/Wire.vue'
import MailIcon from '@/Components/Icons/Mail.vue'
import WebIcon from '@/Components/Icons/Web.vue'

import DashboardIcon from '@/Components/Icons/Dashboard.vue'
import MindExplorerIcon from '@/Components/Icons/MindExplorer.vue'
import TopicsIcon from '@/Components/Icons/Topics.vue'
import ResourcesIcon from '@/Components/Icons/Resources.vue'
import LessonsIcon from '@/Components/Icons/Lessons.vue'
import UsersIcon from '@/Components/Icons/Users.vue'
import UserIcon from '@/Components/Icons/User.vue'
import SettingsIcon from '@/Components/Icons/Settings.vue'
import LogOutIcon from '@/Components/Icons/LogOut.vue'

import GridIcon from '@/Components/Icons/Grid.vue'
import ListIcon from '@/Components/Icons/List.vue'
import SearchIcon from '@/Components/Icons/Search.vue'
import FilterIcon from '@/Components/Icons/Filter.vue'
import PlusIcon from '@/Components/Icons/Plus.vue'

import TopicsForm from '@/Components/Forms/TopicForm.vue'
import ResourcesForm from '@/Components/Forms/ResourceForm.vue'
import LessonsForm from '@/Components/Forms/LessonForm.vue'
import FilterForm from '@/Components/Forms/FilterForm.vue'

import TopicFolderIcon from '@/Components/Previews/TopicFolder.vue'
import ResourceFolderIcon from '@/Components/Previews/ResourceFolder.vue'
import LessonFolderIcon from '@/Components/Previews/LessonFolder.vue'

import NoDataIcon from '@/Components/Backgrounds/Nodata.vue'

import HomeIcon from '@/Components/Icons/Home.vue'
import ArrowIcon from '@/Components/Icons/Arrow.vue'

import LinkIcon from '@/Components/Icons/Link.vue'
import ImageIcon from '@/Components/Icons/Image.vue'
import VideoIcon from '@/Components/Icons/Video.vue'

export const menuMap = {
    Dashboard: DashboardIcon,
    MindExplorer: MindExplorerIcon,
    Topics: TopicsIcon,
    Lessons: LessonsIcon,
    Resources: ResourcesIcon,
    Users: UsersIcon,
    User: UserIcon,
    Settings: SettingsIcon,
    LogOut: LogOutIcon,
}

export const iconMap = {
    Law: LawIcon,
    Network: NetworkIcon,
    System: SystemIcon,
    Database: DatabaseIcon,
    Program: ProgramIcon,
    Wire: WireIcon,
    Mail: MailIcon,
    Web: WebIcon,
}

export const entityMap = {
    Topics: TopicsIcon,
    Resources: ResourcesIcon,
    Lessons: LessonsIcon,
}

export const optionsMap = {
    Grid: GridIcon,
    List: ListIcon,
    Filter: FilterIcon,
    Search: SearchIcon,
    Plus: PlusIcon,
}

export const formMap = {
    Topics: TopicsForm,
    Resources: ResourcesForm,
    Lessons: LessonsForm,
    Filter: FilterForm,
}

export const previewMap = {
    Topic: TopicFolderIcon,
    Resource: ResourceFolderIcon,
    Lesson: LessonFolderIcon,
}

export const backgroundMap = {
    NoData: NoDataIcon,
}

export const breadcrumbMap = {
    'Home': HomeIcon,
    'Arrow': ArrowIcon,
}

export const fileTypeMap = {
    'link': LinkIcon,
    'img': ImageIcon,
    'video': VideoIcon,
}
