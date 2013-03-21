## CHANGELOG ##

#### v1.1.1 (2013-XX-XX) ####
- CompilerPass tworzący abstrakcyjne repozytoria bazowe dla obiektów obsługiwanych przez DoctrineORM i DoctrineMongoDB.
- Zmiana nazwy (`StringToEnumTransformer` -> `EnumToValueTransformer`) i refaktoring transformera wykorzystywanego w `EnumType`

#### v1.0.0 (2013-03-21) ####
- Dodanie `DoctrineRepositoryPass` do ładowania abstrakcyjnych repozytoriów ORM i ODM
- Refaktoring opcji `range_suffix` w `RangeType`
- Dodanie opcji `trans_prefix` oraz `trans_domain` w `EnumType`
- Dodanie `TransEnumExtension` z filtrem `trans_enum`
