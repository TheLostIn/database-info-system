<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-tickets"></i> 基础表格</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="container">
            <div class="handle-box">
                <el-button type="primary" icon="delete" class="handle-del mr10" @click="delAll">批量删除</el-button>
                <el-select v-model="select_cate" placeholder="筛选系" class="handle-select mr10"  @change="search">
                    <el-option value="" label="所有"></el-option>
                    <el-option v-for="dept in dept_list" :key="dept.Sdept" :label="dept.Sdept" :value="dept.Sdept"></el-option>
                </el-select>
                <el-input v-model="select_word" placeholder="筛选关键词" @change="search" class="handle-input mr10"></el-input>
                <el-button type="primary" icon="search" @click="search" >搜索</el-button>
                <el-button type="primary" icon="search" @click="handleAdd">添加</el-button>
            </div>
            <el-table :data="data" border style="width: 100%" ref="multipleTable" @selection-change="handleSelectionChange">
                <el-table-column type="selection" width="55"></el-table-column>
                <!-- <el-table-column prop="date" label="日期" sortable width="150">
                </el-table-column> -->
                <el-table-column prop="Sno" sortable label="学号" width="120">
                </el-table-column>
                <el-table-column prop="Sage" sortable label="年龄" width="120">
                </el-table-column>
                <el-table-column prop="Sname" sortable label="姓名" width="120">
                </el-table-column>
                <el-table-column prop="Sdept" sortable label="系" width="120">
                </el-table-column>
                <el-table-column prop="Ssex" sortable label="性别" width="120">
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <el-button size="small" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button size="small" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div class="pagination">
                <el-pagination @current-change="handleCurrentChange" layout="prev, pager, next" :total="1000">
                </el-pagination>
                 <el-input v-model="page_num" placeholder="单页记录数" class="handle-input mr10"></el-input>
                 <el-button type="primary" icon="search" @click="changePagenum">确定</el-button>
            </div>
        </div>

        <!-- 编辑弹出框 -->
        <el-dialog title="编辑" :visible.sync="editVisible" width="30%">
            <el-form ref="form" :model="form" label-width="50px">
                <el-form-item label="姓名">
                    <el-input v-model="form.Sname"></el-input>
                </el-form-item>
                <el-form-item label="学号">
                    <el-input v-model="form.Sno"></el-input>
                </el-form-item>
                <el-form-item label="年龄">
                    <el-input v-model="form.Sage"></el-input>
                </el-form-item>
                <el-form-item label="系名">
                    <el-input v-model="form.Sdept"></el-input>
                </el-form-item>
                <el-form-item label="性别">
                    <el-input v-model="form.Ssex"></el-input>
                </el-form-item>

            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveEdit">确 定</el-button>
            </span>
        </el-dialog>
        <!-- 添加弹出框 -->
        <el-dialog title="添加" :visible.sync="addVisible" width="30%">
            <el-form ref="form" :model="form" label-width="50px">
                <el-form-item label="姓名">
                    <el-input v-model="form.Sname"></el-input>
                </el-form-item>
                <el-form-item label="学号">
                    <el-input v-model="form.Sno"></el-input>
                </el-form-item>
                <el-form-item label="年龄">
                    <el-input v-model="form.Sage"></el-input>
                </el-form-item>
                <el-form-item label="系名">
                    <el-input v-model="form.Sdept"></el-input>
                </el-form-item>
                <el-form-item label="性别">
                    <el-input v-model="form.Ssex"></el-input>
                </el-form-item>

            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveAdd">确 定</el-button>
            </span>
        </el-dialog>

        <!-- 删除提示框 -->
        <el-dialog title="提示" :visible.sync="delVisible" width="300px" center>
            <div class="del-dialog-cnt">删除不可恢复，是否确定删除？</div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="delVisible = false">取 消</el-button>
                <el-button type="primary" @click="deleteRow">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '/index.php?_action=getStudent',
                tableData: [],
                cur_page: 0,
                multipleSelection: [],
                select_cate: '',
                select_word: '',
                select_dept:'',
                dept_list: [],
                del_list: [],
                is_search: false,
                editVisible: false,
                addVisible: false,
                delVisible: false,
                page_num:5,
                delSno:'',
                form: {
                    Sname: '',
                    Sno: '',
                    Sage: '',
                    Sdept: '',
                    Ssex:''
                },
                idx: -1
            }
        },
        created() {
            this.getData();
        },
        computed: {
            data() {
                return this.tableData.filter((d) => {
                    let is_del = false;
                    console.log(d)
                    return d;
                    // for (let i = 0; i < this.del_list.length; i++) {
                    //     if (d.Sno === this.del_list[i].Sno) {
                    //         is_del = true;
                    //         break;
                    //     }
                    // }
                    // if (!is_del) {
                    //     if (d.Sno.indexOf(this.select_cate) > -1 &&
                    //         (d.Sage.indexOf(this.select_word) > -1 ||
                    //             d.Sdept.indexOf(this.select_word) > -1)
                    //     ) {
                    //         return d;
                    //     }
                    // }
                })
            }
        },
        methods: {
            // 分页导航
            handleCurrentChange(val) {
                this.cur_page = val-1;
                this.getData();
            },
            changePagenum(){
                this.getData();
            },
            // 获取 easy-mock 的模拟数据
            getData() {
                // 开发环境使用 easy-mock 数据，正式环境使用 json 文件
                // if (process.env.NODE_ENV === 'development') {
                //     this.url = '/ms/table/list';
                // };
                this.$axios.get(this.$domin+this.url+'&action_type=get_s&page='+this.cur_page+'&page_num='+this.page_num+'&word='+this.select_word+'&dept='+this.select_cate).then((res) => {
                    console.log(res);
                    if(res.data.data){
                        this.tableData = res.data.data;
                    } else {
                        this.$message.error('没有查询到相关信息');
                    }
                })
                this.$axios.get(this.$domin+this.url+'&action_type=get_dept&page='+this.cur_page+'&page_num='+this.page_num+'&word='+this.select_word).then((res) => {
                    console.log(res);
                    if(res.data.data){
                        this.dept_list = res.data.data;
                    }
                })
            },
            search() {
                this.is_search = true;
                this.cur_page = 0;
                this.getData();
                // this.$axios.get(this.$domin+this.url+'&action_type=search_s&word='+this.select_word).then((res) => {
                //     if(res.data.data){
                //     console.log(res);
                //         this.tableData = res.data.data;
                //     }
                // })
            },
            formatter(row, column) {
                return row.address;
            },
            filterTag(value, row) {
                return row.tag === value;
            },
            handleEdit(index, row) {
                this.idx = index;
                const item = this.tableData[index];
                this.form = {
                    Sname : item.Sname,
                    Sno : item.Sno,
                    Sage : item.Sage,
                    Sdept : item.Sdept,
                    Ssex : item.Ssex
                }
                this.editVisible = true;
            },
            handleDelete(index, row) {
                this.idx = index;
                const item = this.tableData[index];
                this.delSno = item.Sno;
                this.delVisible = true;
            },
            delAll() {
                const length = this.multipleSelection.length;
                let str = '';
                this.del_list = this.del_list.concat(this.multipleSelection);
                for (let i = 0; i < length; i++) {
                    str += this.multipleSelection[i].name + ' ';
                }
                this.$message.error('删除了' + str);
                this.multipleSelection = [];
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            // 保存编辑
            saveEdit() {
                this.$set(this.tableData, this.idx, this.form);
                this.editVisible = false;
                this.$axios.get(this.$domin+this.url+'&action_type=update_s'+
                    '&Sname='+ this.form.Sname+
                    '&Sno='+ this.form.Sno+
                    '&Sage='+ this.form.Sage+
                    '&Sdept='+ this.form.Sdept+
                    '&Ssex='+ this.form.Ssex
                ).then((res) => {
                    console.log(res);
                //    this.tableData = res.data.data;
                })
                this.$message.success(`修改第 ${this.idx+1} 行成功`);
            },
            // 确定删除
            deleteRow(){
                this.$axios.get(this.$domin+this.url+'&action_type=delete_s'+
                    '&Sno='+ this.delSno
                ).then((res) => {
                    console.log(res);
                })
                this.tableData.splice(this.idx, 1);
                this.$message.success('删除成功');
                this.delVisible = false;
            },
            handleAdd() {
                this.form = {
                    Sname : '',
                    Sno : '',
                    Sage : '',
                    Sdept : '',
                    Ssex : ''
                }
                this.addVisible = true;
            },
            saveAdd(){
                this.addVisible = false;
                this.$axios.get(this.$domin+this.url+'&action_type=insert_s'+
                    '&Sname='+ this.form.Sname+
                    '&Sno='+ this.form.Sno+
                    '&Sage='+ this.form.Sage+
                    '&Sdept='+ this.form.Sdept+
                    '&Ssex='+ this.form.Ssex
                ).then((res) => {
                    console.log(res);
                    if(res.data.data.status==1)
                    {
                        this.$message.success(`修改第 ${this.idx+1} 行成功`);
                    }else{
                        this.$message.error(`学号已存在`);

                    }
                //    this.tableData = res.data.data;
                })
            }
        }
    }

</script>

<style scoped>
    .handle-box {
        margin-bottom: 20px;
    }

    .handle-select {
        width: 120px;
    }

    .handle-input {
        width: 300px;
        display: inline-block;
    }
    .del-dialog-cnt{
        font-size: 16px;
        text-align: center
    }
</style>
