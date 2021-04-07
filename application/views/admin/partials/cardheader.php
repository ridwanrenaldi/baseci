            <div class="card-header">
              <h3 class="card-title"><?php if(isset($card_title)){echo $card_title;} ?></h3>
              <?php if(isset($btn_add)){ ?>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a href="<?= $btn_add['url'] ?>">
                      <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-plus-square"></i> <?= $btn_add['name'] ?></button>
                    </a>
                  </li>
                </ul>
              </div>
              <?php } ?>
            </div>
            <!-- /.card-header -->